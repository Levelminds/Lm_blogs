<?php

namespace App\Services;

use App\Models\PageBlock;
use App\Models\PageSection;
use App\Models\PageTemplate;
use App\Models\ThemeSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use JsonException;
use RuntimeException;

class PageTemplateImporter
{
    private const DEFAULT_THEME_NAME = 'Default';

    private const DEFAULT_THEME_ATTRIBUTES = [
        'primary_color' => '#1f2937',
        'secondary_color' => '#111827',
        'accent_color' => '#f97316',
        'text_color' => '#1f2937',
        'heading_font' => 'Poppins',
        'body_font' => 'Inter',
        'palette' => [
            'primary' => '#1f2937',
            'secondary' => '#4b5563',
            'accent' => '#f97316',
            'muted' => '#e5e7eb',
        ],
        'global_styles' => [
            'button' => [
                'radius' => '0.75rem',
                'shadow' => '0 10px 30px rgba(15, 23, 42, 0.15)',
            ],
        ],
    ];

    /**
     * Import a template definition from a JSON file.
     */
    public function importFromFile(string $path): PageTemplate
    {
        if (! File::exists($path)) {
            throw new RuntimeException("Template file not found: {$path}");
        }

        try {
            $data = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException(sprintf('Unable to decode template JSON (%s): %s', $path, $exception->getMessage()));
        }

        if (! is_array($data)) {
            throw new RuntimeException('Template definition must decode to an array.');
        }

        return $this->importFromArray($data);
    }

    /**
     * Import a template from an array payload.
     */
    public function importFromArray(array $data): PageTemplate
    {
        if (empty($data['slug'])) {
            throw new RuntimeException('Template slug is required.');
        }

        $sections = $data['sections'] ?? [];
        if (! is_array($sections) || empty($sections)) {
            throw new RuntimeException(sprintf('Template "%s" must include at least one section.', $data['slug']));
        }

        $theme = $this->resolveTheme($data['theme'] ?? null);

        $templateAttributes = Arr::only($data, [
            'name',
            'slug',
            'status',
            'layout_variant',
            'description',
            'meta',
            'published_at',
        ]);

        $templateAttributes['status'] = $templateAttributes['status'] ?? 'draft';
        $templateAttributes['theme_setting_id'] = $theme?->id;

        return DB::transaction(function () use ($sections, $templateAttributes) {
            $template = PageTemplate::query()->updateOrCreate(
                ['slug' => $templateAttributes['slug']],
                $templateAttributes,
            );

            $template->sections()->each(function (PageSection $section) {
                $section->blocks()->delete();
                $section->delete();
            });

            foreach ($sections as $index => $sectionData) {
                $sectionAttributes = Arr::only($sectionData, [
                    'title',
                    'handle',
                    'type',
                    'position',
                    'settings',
                    'content',
                    'background_media_id',
                ]);

                $sectionAttributes['page_template_id'] = $template->id;
                $sectionAttributes['position'] = $sectionAttributes['position'] ?? $index + 1;

                $section = PageSection::query()->create($sectionAttributes);

                $blocks = $sectionData['blocks'] ?? [];
                foreach ($blocks as $blockIndex => $blockData) {
                    $blockAttributes = Arr::only($blockData, [
                        'type',
                        'title',
                        'position',
                        'content',
                        'settings',
                    ]);

                    $blockAttributes['page_section_id'] = $section->id;
                    $blockAttributes['position'] = $blockAttributes['position'] ?? $blockIndex + 1;

                    PageBlock::query()->create($blockAttributes);
                }
            }

            return $template->fresh(['sections.blocks']);
        });
    }

    private function resolveTheme(?array $themeData): ?ThemeSetting
    {
        if ($themeData === null) {
            return ThemeSetting::query()->first();
        }

        if (isset($themeData['id'])) {
            return ThemeSetting::query()->find($themeData['id']);
        }

        $name = $themeData['name'] ?? self::DEFAULT_THEME_NAME;

        return ThemeSetting::query()->firstOrCreate(
            ['name' => $name],
            self::DEFAULT_THEME_ATTRIBUTES,
        );
    }
}
