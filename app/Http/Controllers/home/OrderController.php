<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CourseOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\ZarinPal;
use App\Models\ZarinPalGetWay;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Kavenegar;



class OrderController extends Controller
{
    use SEOTools;



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
            $discount = !is_null($item->course->discount_price) ? $item->course->discount_price : 0;
            CourseOrder::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'course_id' => $item->course->id,
                'part_id' => !is_null($item->part) ? $item->part->id : null,
                'total' => $item->course->price - $discount,
            ]);
        }


        if ($totalPrice != 0) {

            $payment = Payment::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'amount' => $totalPrice,
            ]);

            $zarinPal = new ZarinPalGetWay($order, $totalPrice, $user, $payment);
            $zarinPal->send();

        } else {
            $order->update([
                'status' => 'پرداخت شده'
            ]);

            header("Location: " . route('order.status', ['order' => $order->id]));
            exit;


        }
    }


    public function status(Order $order)
    {
        $this->seo()->setTitle("وضعیت پرداخت سفارش #$order->id");

        if ($order->total != 0) {
            $zarinPal = new ZarinPalGetWay();
            $zarinPal->verify($order);
        }

        if ($order->status == "پرداخت شده" && !$order->status_processed) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();

            if ($cart) {
                $cart->delete();
            }

            foreach ($order->courseOrders as $item) {
                UserCourse::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => $item->course_id,
                    'part_id' => $item->part_id
                ]);


                if ($item->course->type == 'online') {
                    try {

                        if (is_null($item->course->remain_capacity)) {
                            $fullRemain = $item->course->capacity ;
                        } else {
                            $fullRemain = $item->course->remain_capacity;
                        }
                        $remain = $fullRemain - 1;

                        $item->course->update([
                            'remain_capacity' => $remain
                        ]);
                    }catch (Exception $exception) {
                        echo $exception->getMessage();
                    }
                }
            }



            $order->update(['status_processed' => true]);

            $this->sendSms($order);

        }

        return view('home.cart.status', compact('order'));

    }


    public function sendSms($order)
    {

        try{
            $receptor = $order->user->phone;
            $token = $order->id;
            $token2 = "";
            $token3 = "";
            $template="completeOrder";
            //Send null for tokens not defined in the template
            //Pass token10 and token20 as parameter 6th and 7th

            $result = Kavenegar::VerifyLookup($receptor, $token, $token2, $token3, $template, $type = null);
            if($result){
                foreach($result as $r){
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }
            }
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
//             $e->errorMessage();
        }

    }


}
