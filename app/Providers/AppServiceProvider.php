<?php

namespace App\Providers;

use App\Models\Background;
use App\Models\Activity;
use App\Models\PageHeader;
use App\Models\Setting;
use App\Support\SocialLinks;
use Illuminate\Support\Facades\Schema;
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
        $setting = Setting::first();
        View::share('setting', $setting);
        View::share('about', Background::first());
        View::share('ourPrograms', Activity::with('images')->oldest()->get());
        try {
            $pageHeaders = Schema::hasTable('page_headers')
                ? PageHeader::all()->keyBy('page_key')
                : collect();
        } catch (\Throwable $e) {
            $pageHeaders = collect();
        }
        View::share('pageHeaders', $pageHeaders);
        View::share('socialLinks', SocialLinks::forSetting($setting));
    }
}
