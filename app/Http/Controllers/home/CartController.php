<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
            'part' => 'nullable|exists:part_times,id',
        ]);


        try {
            $cartItem = Cart::updateOrCreate([
                'user_id' => auth()->id(),
                'course_id' => $validated['course'],
                'part_id' => $validated['part'] ?? null,
            ]);
        }catch (Exception $exception) {
            dd($exception);
        }

        Alert::success("با موفقیت به سبد خرید اضافه شد.");
        return redirect()->route('cart.index');
    }


}
