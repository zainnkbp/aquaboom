<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PruneUploadsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prune-uploads {--dry-run : Only report unreferenced files without deleting them}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up unused and orphaned upload files from public/uploads to keep server disk lean';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Scanning database for active referenced files...');

        $activeFiles = $this->collectActiveFiles();
        $this->info('Found ' . count($activeFiles) . ' active file references in database.');

        $uploadsDir = public_path('uploads');
        if (!File::exists($uploadsDir)) {
            $this->warn('public/uploads directory does not exist.');
            return Command::SUCCESS;
        }

        $allDiskFiles = File::allFiles($uploadsDir);
        $totalDiskFiles = count($allDiskFiles);
        $this->info("Scanning public/uploads directory ({$totalDiskFiles} files found)...");

        $deletedCount = 0;
        $freedBytes = 0;
        $isDryRun = $this->option('dry-run');

        foreach ($allDiskFiles as $file) {
            $relativePath = str_replace(public_path('uploads') . DIRECTORY_SEPARATOR, '', $file->getRealPath());
            $relativePath = str_replace('\\', '/', $relativePath);
            $fileName = $file->getFilename();

            // Check if file is active
            $isUsed = false;
            foreach ($activeFiles as $active) {
                if (Str::endsWith($active, $relativePath) || Str::endsWith($active, $fileName) || $active === $relativePath) {
                    $isUsed = true;
                    break;
                }
            }

            if (!$isUsed) {
                $fileSize = $file->getSize();
                $freedBytes += $fileSize;
                $deletedCount++;

                if ($isDryRun) {
                    $this->line("<comment>[DRY RUN]</comment> Unreferenced: {$relativePath} (" . round($fileSize / 1024, 2) . " KB)");
                } else {
                    File::delete($file->getRealPath());
                    $this->line("<fg=red>[DELETED]</> {$relativePath} (" . round($fileSize / 1024, 2) . " KB)");
                }
            }
        }

        // Clean empty directories in public/uploads
        if (!$isDryRun) {
            $subDirs = File::directories($uploadsDir);
            foreach ($subDirs as $dir) {
                if (count(File::allFiles($dir)) === 0) {
                    File::deleteDirectory($dir);
                    $this->line("<fg=yellow>[REMOVED EMPTY DIR]</> " . basename($dir));
                }
            }
        }

        $freedMb = round($freedBytes / (1024 * 1024), 2);
        $this->newLine();
        if ($isDryRun) {
            $this->info("DRY RUN COMPLETE: {$deletedCount} unused files can be pruned ({$freedMb} MB potential space freed).");
        } else {
            $this->info("SUCCESS: {$deletedCount} unused files pruned. {$freedMb} MB disk space successfully freed!");
            $remaining = count(File::allFiles($uploadsDir));
            $this->info("Active files remaining in public/uploads: {$remaining} files.");
        }

        return Command::SUCCESS;
    }

    /**
     * Collect all file paths referenced in the database.
     */
    protected function collectActiveFiles(): array
    {
        $files = [];

        // 1. Wahanas
        try {
            $wahanas = \App\Models\Wahana::withTrashed()->pluck('image_url')->filter();
            foreach ($wahanas as $val) {
                $files[] = $this->sanitizePath($val);
            }
        } catch (\Throwable) {}

        // 2. Ticket Packages
        try {
            foreach (\App\Models\TicketPackage::withTrashed()->pluck('image_url')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
            foreach (\App\Models\TicketPackage::withTrashed()->pluck('banner_image')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
        } catch (\Throwable) {}

        // 3. Add-Ons
        try {
            foreach (\App\Models\AddOn::pluck('image')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
            foreach (\App\Models\AddOn::pluck('image_url')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
        } catch (\Throwable) {}

        // 4. Facilities (including menu_items array)
        try {
            foreach (\App\Models\Facility::pluck('image_url')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
            foreach (\App\Models\Facility::pluck('menu_items')->filter() as $menuItems) {
                if (is_array($menuItems)) {
                    foreach ($menuItems as $item) {
                        if (is_string($item)) {
                            $files[] = $this->sanitizePath($item);
                        }
                    }
                }
            }
        } catch (\Throwable) {}

        // 5. Settings
        try {
            $settings = \App\Models\Setting::pluck('value')->filter();
            foreach ($settings as $val) {
                if (is_string($val) && (Str::contains($val, ['uploads/', 'wahanas/', 'packages/', 'facilities/', 'addons/', '.jpg', '.jpeg', '.png', '.webp']))) {
                    $files[] = $this->sanitizePath($val);
                }
            }
        } catch (\Throwable) {}

        // 6. Users Avatar
        try {
            foreach (\App\Models\User::pluck('avatar_url')->filter() as $val) {
                $files[] = $this->sanitizePath($val);
            }
        } catch (\Throwable) {}

        return array_unique(array_filter($files));
    }

    protected function sanitizePath(string $val): string
    {
        $val = str_replace('\\', '/', $val);
        if (Str::contains($val, '/uploads/')) {
            $val = Str::after($val, '/uploads/');
        }
        return ltrim($val, '/');
    }
}
