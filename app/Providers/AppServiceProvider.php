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

        // Ensure admin Livewire pages never fall back to the public frontbase layout.
        if (function_exists('Livewire\\on')) {
            \Livewire\on('render', function ($component, $view, $data = null) {
                if (! is_object($component) || ! is_object($view)) {
                    return;
                }
                if (! str_starts_with($component::class, 'App\\Livewire\\Admin\\')) {
                    return;
                }
                if ($component::class === 'App\\Livewire\\Admin\\AdminComponent') {
                    return;
                }
                try {
                    $view->layout('layouts.adminbase');
                } catch (\Throwable $e) {
                    // Layout macro unavailable — AdminComponent::adminView() still sets it.
                }
            });
        }
    }
}
