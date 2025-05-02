<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // کامپوزر برای هدر
        View::composer('layouts.header', function ($view) {
            $categories = Cache::remember('header_categories', now()->addHours(24), function () {
                return Category::with(['children.children'])
                    ->where('parent_id', null)
                    ->orderBy('order_column')
                    ->get();
            });

            $view->with('headerCategories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
