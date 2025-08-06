<?php

namespace App\Providers;

use App\Models\Background;
use App\Models\Program;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        View::share('setting', Setting::first());
        View::share('about', Background::first());
        View::share('programs', Program::with('activities')->oldest()->get());
    }
}
