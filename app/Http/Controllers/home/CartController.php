<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    use SEOTools;

    public function index()
    {
        $this->seo()->setTitle('سبد خرید');

        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('home.cart.index', $cartItems);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course' => 'required|exists:courses,id',
            'part' => 'nullable|exists:parts,id',
        ]);
        dd('fd');

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $existingCartItem = CartItem::where('cart_id', $cart->id)
            ->where('course_id', $validated['course'])
            ->first();

        if ($existingCartItem) {
            Alert::error("شما قبلا این دوره را به سبد خرید  اضافه کرده اید. ");
            return redirect()->back();
        }


        $item= CartItem::create([
            'cart_id' => $cart->id,
            'course_id' => $validated['course'],
            'part_id' => $validated['part'] ?? null,
        ]);

        Alert::success("با موفقیت به سبد اضافه شد");
        return redirect()->route('cart.index');
    }


}
