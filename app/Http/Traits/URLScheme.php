<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

trait URLScheme {

    /**
     * This function will check if the app is running on the
     * local environment or production environment
     *
     * @return bool
     */
    public function isSecureScheme(): bool
    {
        return App::environment('local') ? false : true;
    }

    /**
     * This function will set the URL scheme based on the environment.
     */
    public function checkURLScheme() {
        if (App::environment('local')) {
            URL::forceScheme('http');
        } else {
            URL::forceScheme('https');
        }
    }


    /**
     * Old way to store images
     * $filename = 'categories/' . uniqid() . '.' . $file->extension(); // categories/6546dgfgfdgfg.jpg
     * $file->storePubliclyAs('public', $filename); // Store inside filesystem categories/6546dgfgfdgfg.jpg
     */

    /**
     * @param $file
     * @return string
     */
    public function categoryFileStore($file): string
    {
        $fileDirectory = 'categories/';
        $fileName = uniqid().'.'.$file->extension();
        if (App::environment('local')) {
            Storage::disk('public')->put($fileDirectory.$fileName, file_get_contents($file));
            return Storage::disk('public')->url($fileDirectory.$fileName);
        } else {
            Storage::disk('s3')->put($fileDirectory.$fileName, file_get_contents($file));
            return Storage::disk('s3')->url($fileDirectory.$fileName);
        }
    }


    /**
     * @param string $oldFilePath
     */
    public function categoryFileDelete(string $oldFilePath)
    {
        $fileDirectory = 'categories/';
         // Returns trailing name component of path e.g. ( 6546dgfgfdgfg.jpg)
        $oldPath = basename($oldFilePath); //
        if (App::environment('local')) {
            Storage::disk('public')->delete($fileDirectory.$oldPath);
        } else {
            Storage::disk('s3')->delete($fileDirectory.$oldPath);
        }
    }
}
