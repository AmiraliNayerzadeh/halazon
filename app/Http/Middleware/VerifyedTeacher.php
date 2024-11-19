<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyedTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->routeIs('teachers.categories.main')) {
            return $next($request);
        }


        if ($request->isMethod('post') || $request->isMethod('put')) {
            return $next($request);
        }
        // بررسی کنید که در حال حاضر در مسیر تکمیل ثبت‌نام هستیم یا خیر
        if (auth()->user()->is_verify == 1) {
            return $next($request);
        } else {


            if ($request->routeIs('teachers.register.complete')) {
                return $next($request);
            }

            return redirect()->route('teachers.register.complete');
        }

    }
}
