<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class CacheServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('home.layouts.main.header', function ($view) {
            // دریافت دسته‌بندی‌ها با کش
            $headerCategories = Cache::remember('header_categories', now()->addDay(), function () {
                return Category::with(['children.children'])
                    ->whereNull('parent_id')
                    ->orderBy('order_column')
                    ->get();
            });

            // محاسبه تعداد سبد خرید
            $cartCount = 0;
            if (auth()->check()) {
                $cartCount = Cache::remember('cart_count_'.auth()->id(), now()->addMinutes(5), function () {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                    return $cart ? $cart->items->count() : 0;
                });
            }

            $view->with([
                'headerCategories' => $headerCategories,
                'cartCount' => $cartCount
            ]);
        });
    }
}
