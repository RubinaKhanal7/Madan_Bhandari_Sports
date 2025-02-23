<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Ensure uploads directory exists
        $uploadsPath = public_path('uploads');
        if (!file_exists($uploadsPath)) {
            mkdir($uploadsPath, 0755, true);
        }

        config(['lfm.disk' => 'public_uploads']);
        config(['lfm.base_directory' => 'uploads']);
    }
}
