<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CourseOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\ZarinPal;
use App\Models\ZarinPalGetWay;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;


class OrderController extends Controller
{
    use SEOTools ;


    public function store(Cart $cart, Request $request)
    {
        $user = auth()->user();

        if ($request['name'] || $request['family']) {
            $this->completeUser($request, $user);
        }

        $this->createOrder($cart, $user);


    }


    public function completeUser(Request $request, $user)
    {

        $userValidate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'gender' => ['nullable', 'in:male,female,other'],
            'birthday' => ['nullable'],

        ]);

        if ($userValidate->fails()) {
            alert()->error('خطا', $userValidate->messages()->all()[0]);
            return back()->withInput();
        }


        $birthday = null;
        if (!is_null($request['birthday'])) {

            try {
                list($year, $month, $day) = explode('/', $request['birthday']);
                $birthday = Jalalian::fromFormat('Y/m/d', "$year/$month/$day")->toCarbon()->format('Y-m-d');
            } catch (\Exception $exception) {

            }
        }

        $user->update([
            'name' => $request['name'],
            'family' => $request['family'],
            'gender' => $request['gender'],
            'birthday' => $birthday,
        ]);

    }


    public function createOrder($cart, $user)
    {

        $pureTotalDiscount = 0;
        $pureTotalPrice = 0;
        $totalPrice = 0;

        foreach ($cart->items as $item) {

            $course = $item->course;
            $quantity = 1;
            $pureTotalDiscount += $course->discount_price;
            $pureTotalPrice += $course->price;
        }
        $totalPrice = $pureTotalPrice - $pureTotalDiscount;


        $order = Order::create([
            'user_id' => $user->id,
            'method' => 'ZarinPal',
            'qty' => count($cart->items),
            'total_pure_price' => $pureTotalPrice,
            'total_discount_price' => $pureTotalDiscount,
            'total' => $totalPrice,

        ]);


        foreach ($cart->items as $item) {
            $discount = !is_null($item->course->discount_price) ? $item->course->discount_price : 0 ;
            CourseOrder::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'course_id' => $item->course->id,
                'part_id' => !is_null($item->part) ? $item->part->id : null,
                'total' => $item->course->price - $discount,
            ]);
        }


        $payment = Payment::create([
            'user_id' => $user->id ,
            'order_id' => $order->id ,
            'amount' => $totalPrice ,
        ]);

        $zarinPal = new ZarinPalGetWay($order , $totalPrice , $user , $payment);
        $zarinPal->send();


    }


    public function status(Order $order)
    {
        $this->seo()->setTitle("وضعیت پرداخت سفارش #$order->id") ;

        $zarinPal = new ZarinPalGetWay();
        $zarinPal->verify($order);

        return view('home.cart.status' , compact('order')) ;


    }





}
