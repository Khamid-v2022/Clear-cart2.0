<?php

namespace App\Providers;

use App;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        // \URL::forceScheme('http');

        if (Schema::hasTable('settings')) {
            foreach (Setting::all() as $setting) {
                Config::set($setting->key, Setting::get($setting->key));

                if (strtolower($setting->key) == 'app.locale') {
                    App::setLocale(strtolower($setting->value));
                }
            }
        }
    }

    public function register()
    {
    }
}
