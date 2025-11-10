<?php

namespace Database\Seeders;

use App\Models\PageBlock;
use App\Models\PageSection;
use App\Models\PageTemplate;
use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;

class PageBuilderSeeder extends Seeder
{
    public function run(): void
    {
        $theme = ThemeSetting::query()->firstOrCreate(
            ['name' => 'Default'],
            [
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
            ]
        );

        $template = PageTemplate::query()->firstOrCreate(
            ['slug' => 'homepage'],
            [
                'name' => 'Homepage',
                'status' => 'published',
                'layout_variant' => 'hero-plus-feature-grid',
                'description' => 'Default marketing homepage assembled from modular sections.',
                'theme_setting_id' => $theme->id,
                'published_at' => now(),
            ]
        );

        if ($template->sections()->exists()) {
            return;
        }

        $hero = PageSection::query()->create([
            'page_template_id' => $template->id,
            'title' => 'Hero',
            'handle' => 'hero',
            'type' => 'hero',
            'position' => 1,
            'settings' => [
                'alignment' => 'left',
                'padding' => 'py-24',
                'background' => [
                    'color' => '#0f172a',
                    'overlay' => 0.55,
                ],
            ],
            'content' => [
                'heading' => 'Build enterprise-ready experiences at startup speed',
                'subheading' => 'An intelligent toolkit to launch, scale, and evolve your digital presence without touching code.',
                'primary_cta' => [
                    'label' => 'Launch Builder',
                    'url' => '/contact',
                ],
                'secondary_cta' => [
                    'label' => 'View Demo',
                    'url' => '/tour',
                ],
            ],
        ]);

        PageBlock::query()->create([
            'page_section_id' => $hero->id,
            'type' => 'stat-pill',
            'title' => 'Social Proof',
            'position' => 1,
            'content' => [
                'items' => [
                    ['label' => 'Live sites launched', 'value' => '480+'],
                    ['label' => 'Average launch time', 'value' => '6 days'],
                    ['label' => 'NPS', 'value' => '74'],
                ],
            ],
        ]);

        $featureGrid = PageSection::query()->create([
            'page_template_id' => $template->id,
            'title' => 'Feature Grid',
            'handle' => 'feature-grid',
            'type' => 'feature-grid',
            'position' => 2,
            'settings' => [
                'columns' => 3,
                'background' => [
                    'color' => '#ffffff',
                ],
            ],
        ]);

        PageBlock::query()->create([
            'page_section_id' => $featureGrid->id,
            'type' => 'feature-card',
            'position' => 1,
            'content' => [
                'title' => 'Visual Builder',
                'description' => 'Craft complex layouts with a responsive drag-and-drop canvas optimised for marketing teams.',
                'icon' => 'sparkles',
            ],
        ]);

        PageBlock::query()->create([
            'page_section_id' => $featureGrid->id,
            'type' => 'feature-card',
            'position' => 2,
            'content' => [
                'title' => 'Design Tokens',
                'description' => 'Control brand colours and typography centrally with instant propagation across every page.',
                'icon' => 'swatch',
            ],
        ]);

        PageBlock::query()->create([
            'page_section_id' => $featureGrid->id,
            'type' => 'feature-card',
            'position' => 3,
            'content' => [
                'title' => 'Workflow Automation',
                'description' => 'Use drafts, approvals, and audit trails to keep governance tight while shipping fast.',
                'icon' => 'shield-check',
            ],
        ]);
    }
}
