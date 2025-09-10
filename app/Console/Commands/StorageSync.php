<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StorageSync extends Command
{
    protected $signature = 'storage:sync';
    protected $description = 'Sync storage/app/public to public/storage';

public function handle()
{
    $from = storage_path('app/public');
    $to = public_path('storage');

    // Agar directory pehle se hai to delete kar do
    if (file_exists($to)) {
        \Illuminate\Support\Facades\File::deleteDirectory($to);
    }

    // Directory dobara create karo
    mkdir($to, 0755, true);

    // Copy all files from storage/app/public to public/storage
    \Illuminate\Support\Facades\File::copyDirectory($from, $to);

    $this->info('Storage directory recreated and files copied successfully!');
}



}
