<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::query()
            ->where('user_id', $user->id)
            ->with([
                'item' => function ($query) {
                    $query->orderBy('id');
                }
            ])
            ->get();

        //합계 금액
        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->item->price * $cart->quantity;
        }

        return view('mypage.cart.index')
            ->with('carts', $carts)
            ->with('total_price', $total_price);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cart\CartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Cart\CartRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        $model = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'item_id' => $id,
        ]);

        $quantity = $request->input('item-quantity');
        $model->quantity = ($model->exists ? $model->quantity : 0) + $quantity;
        $model->save();

        return redirect()->back()
            ->with('status', 'cart success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);

        return redirect(route('cart.index'));
    }
}
