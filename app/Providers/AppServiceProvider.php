<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Favicon;
use App\Models\Service;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        app()->setLocale('ne');
        

    // Check if Laravel is running in the console
    if (!app()->runningInConsole()) {
        $favicon = Favicon::latest()->first();
        View::share('favicon', $favicon);

        $sitesetting = SiteSetting::first();
        View::share('sitesetting', $sitesetting);

        View::composer('frontend.includes.navbar', function ($view) {
           
           
            $categories = Category::all();
           
            $sitesetting = SiteSetting::first();


            $view->with([
             
                
                'categories' => $categories,
                'sitesetting' => $sitesetting
            ]);

        });

        view()->composer('frontend.includes.footer', function ($view) {
            $services = Service::all();
            $categories = Category::all();
           
            $siteSettings = SiteSetting::first();
            $about = About::first();


            $view->with([
                'services' => $services,
               
                'siteSettings' => $siteSettings,
                'categories' => $categories,
                'about' => $about,
                'sitesetting' => SiteSetting::first(),
            ]);

        });
    }
    }

}
