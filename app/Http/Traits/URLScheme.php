<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\App;
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
}
