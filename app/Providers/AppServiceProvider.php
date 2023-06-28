<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\Page;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {
            $view->with([
                'categories_sidebar' => Category::where('parent_id', 0)->get(),
                'category_sidebar' => Category::where('status','1')->get(),
                'menu_header' => Menu::where('status', 1)->where('parent_id',1)->get(),
                'slider_home' => Slider::where('status', 1)->get(),
                'page_header_footer' => Page::where('status', 1)->get(),
                'product_selling' => Product::where('status', 1)->orderBy('selling','desc')->limit(10)->get(),
            ]);
        });
    }
}
