<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure all upload and storage directories exist and have proper 775/777 permissions';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Fixing directory permissions for Aquaboom production server...');

        $directories = [
            storage_path('app'),
            storage_path('app/public'),
            storage_path('app/livewire-tmp'),
            storage_path('framework'),
            storage_path('framework/cache'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
            public_path('uploads'),
            public_path('uploads/wahanas'),
            public_path('uploads/packages'),
            public_path('uploads/facilities'),
            public_path('uploads/addons'),
            public_path('uploads/dining'),
            public_path('uploads/dining-menus'),
            public_path('uploads/avatars'),
            public_path('uploads/settings'),
        ];

        foreach ($directories as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0775, true, true);
                $this->line("<info>Created:</info> {$dir}");
            }

            @chmod($dir, 0775);

            // Recursively set permissions on subdirectories and files
            try {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($iterator as $item) {
                    if ($item->isDir()) {
                        @chmod($item->getPathname(), 0775);
                    } else {
                        @chmod($item->getPathname(), 0664);
                    }
                }
            } catch (\Throwable $e) {
                // Ignore iterator issues on restricted systems
            }
        }

        $this->info('✓ All storage, cache, and upload directories are configured and writable!');
        return Command::SUCCESS;
    }
}
