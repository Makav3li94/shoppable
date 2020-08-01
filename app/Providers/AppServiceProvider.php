<?php

namespace App\Providers;

use App\Models\ShopAd;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\ModelTrait;
use DB;

class AppServiceProvider extends ServiceProvider
{
    use ModelTrait;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    public function boot()
    {

        $ads = DB::table('pa_shop_ads')
            ->leftJoin('pa_shop_ad_description', 'pa_shop_ad_description.ad_id','pa_shop_ads.id')
            ->get();
        view()->share('ads', $ads);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //Dont use migrate from library passport
        Passport::ignoreMigrations();
    }
}
