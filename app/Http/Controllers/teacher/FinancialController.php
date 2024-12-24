<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    use SEOTools ;

    public function index(Request $request)
    {
        $this->seo()->setTitle('بخش مالی') ;

        $teacher = auth()->user();
        $teacherId = auth()->user()->id;

        $paidOrders = Order::where('status', 'پرداخت شده')  // وضعیت "پرداخت شده"
        ->with(['courseOrders' => function($query) use ($teacherId) {
            $query->whereHas('course', function($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            });
        }])->latest()->get();


        $totalRevenue = $paidOrders->flatMap(function($order) {
            return $order->courseOrders;
        })->sum(function($courseOrder) {
            // محاسبه سهم معلم از هر دوره
            return $courseOrder->total * ($courseOrder->revenue / 100);
        });


        $totalNotSettled = $paidOrders->flatMap(function($order) {
            return $order->courseOrders->where('is_settled' , 0);
        })->sum(function($courseOrder) {
            // محاسبه سهم معلم از هر دوره
            return $courseOrder->total * ($courseOrder->revenue / 100);
        });





        return view('teacher.financial.index' , compact('paidOrders' , 'totalRevenue' , 'totalNotSettled'));

    }
}
