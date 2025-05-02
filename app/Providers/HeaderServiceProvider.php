<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class HeaderCacheServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('home.layouts.main.header', function ($view) {
            // همیشه مقدار پیش‌فرض تعریف کنید
            $defaultData = [
                'categories' => collect(),
                'cartCount' => 0
            ];

            try {
                // دریافت دسته‌بندی‌ها با کش
                $categories = Cache::remember('header_categories', now()->addHours(24), function () {
                    return Category::with(['children.children'])
                        ->whereNull('parent_id')
                        ->orderBy('created_at', 'desc')
                        ->get();
                });

                $defaultData['categories'] = $categories;

                // محاسبه تعداد سبد خرید فقط برای کاربران لاگین کرده
                if (auth()->check()) {
                    $defaultData['cartCount'] = Cache::remember('cart_count_'.auth()->id(),
                        now()->addMinutes(5),
                        function () {
                            $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                            return $cart ? $cart->items->count() : 0;
                        });
                }

            } catch (\Exception $e) {
                Log::error('Header View Composer Error: '.$e->getMessage());
            }

            $view->with($defaultData);
        });
    }
}
