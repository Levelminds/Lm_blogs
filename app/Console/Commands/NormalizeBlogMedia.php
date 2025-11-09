<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class NormalizeBlogMedia extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'blogs:normalize-media {--dry-run : Show the changes without updating the database.}';

    /**
     * The console command description.
     */
    protected $description = 'Ensure blog media paths are stored relative to the public disk.';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $updated = 0;
        $examined = 0;

        Blog::chunkById(100, function ($blogs) use (&$updated, &$examined, $dryRun) {
            foreach ($blogs as $blog) {
                $examined++;

                $changes = $this->normalizeBlogMediaAttributes($blog);

                if (empty($changes)) {
                    continue;
                }

                if ($dryRun) {
                    $this->line(sprintf('Blog %d changes: %s', $blog->id, json_encode($changes)));
                } else {
                    $blog->forceFill($changes)->save();
                }

                $updated++;
            }
        });

        if ($dryRun) {
            $this->components->info("{$examined} blog(s) inspected. {$updated} would be updated.");
        } else {
            $this->components->info("{$examined} blog(s) inspected. {$updated} updated.");
        }

        return self::SUCCESS;
    }

    protected function normalizeBlogMediaAttributes(Blog $blog): array
    {
        $attributes = [
            'thumbnail' => $blog->thumbnail,
            'og_image' => $blog->og_image,
            'video_path' => $blog->video_path,
        ];

        $changes = [];

        foreach ($attributes as $column => $value) {
            $normalized = $this->normalizeMediaPath($value);

            if ($normalized !== $value) {
                $changes[$column] = $normalized;
            }
        }

        return $changes;
    }

    protected function normalizeMediaPath(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim(str_replace('\\', '/', $value));

        if ($value === '') {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//'])) {
            return $value;
        }

        $value = ltrim($value, '/');

        $prefixes = [
            'storage/',
            'public/',
            'app/public/',
            'public/storage/',
            'storage/app/public/',
        ];

        do {
            $original = $value;

            foreach ($prefixes as $prefix) {
                if (Str::startsWith($value, $prefix)) {
                    $value = ltrim(substr($value, strlen($prefix)), '/');
                }
            }
        } while ($value !== $original);

        return $value ?: null;
    }
}
