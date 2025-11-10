<?php

namespace Database\Seeders;

use App\Services\PageTemplateImporter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageBuilderSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('templates');

        if (! File::isDirectory($path)) {
            return;
        }

        $importer = app(PageTemplateImporter::class);

        foreach (File::files($path) as $file) {
            if ($file->getExtension() !== 'json') {
                continue;
            }

            $importer->importFromFile($file->getRealPath());
        }
    }
}
