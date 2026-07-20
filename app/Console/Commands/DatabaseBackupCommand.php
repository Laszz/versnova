<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'database:backup';
    protected $description = 'Backup the database';

    public function handle()
    {
        $path = 'backups/' . now()->format('Y-m-d-Hi') . '.sqlite';
        Storage::disk('local')->put($path, file_get_contents(database_path('database.sqlite')));

        // prune backups older than 7 days
        foreach (Storage::disk('local')->files('backups') as $file) {
            if (Storage::disk('local')->lastModified($file) < now()->subDays(7)->timestamp) {
                Storage::disk('local')->delete($file);
            }
        }

        $this->info('Database backed up.');
    }
}
