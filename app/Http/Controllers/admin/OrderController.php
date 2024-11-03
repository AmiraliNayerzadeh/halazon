<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->seo()->setTitle('سفارشات');
        $orders = Order::latest()->paginate(12) ;

        return view('admin.orders.index' , compact('orders')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->seo()->setTitle("مشاهده جزئیات سفارش #$order->id");
        return view('admin.orders.show' , compact('order')) ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
