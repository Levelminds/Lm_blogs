<?php

namespace App\Console\Commands;

use App\Services\PageTemplateImporter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class ImportPageTemplates extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'builder:import-templates {path? : Directory or JSON file to import}';

    /**
     * The console command description.
     */
    protected $description = 'Import page templates for the builder from JSON fixtures.';

    public function handle(PageTemplateImporter $importer): int
    {
        $path = $this->argument('path') ?? database_path('templates');

        if (! File::exists($path)) {
            $this->error("Path not found: {$path}");

            return self::FAILURE;
        }

        $files = File::isDirectory($path)
            ? array_filter(File::files($path), fn (SplFileInfo $file) => $file->getExtension() === 'json')
            : [new SplFileInfo($path)];

        if (empty($files)) {
            $this->warn('No JSON templates found to import.');

            return self::FAILURE;
        }

        foreach ($files as $file) {
            /** @var SplFileInfo $file */
            $this->info("Importing {$file->getFilename()}...");

            try {
                $template = $importer->importFromFile($file->getRealPath());
            } catch (\Throwable $exception) {
                $this->error("  Failed: {$exception->getMessage()}");

                return self::FAILURE;
            }

            $this->line(sprintf('  Imported template "%s" (%s).', $template->name, $template->slug));
        }

        $this->info('Template import complete.');

        return self::SUCCESS;
    }
}
