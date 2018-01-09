<?php

namespace Modules\Admin\Providers;

use App\Models\User;
use Modules\Admin\Auth\AdminAuthProvider;
use Illuminate\Support\ServiceProvider;

class AdminAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}