<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::query()
            ->whereIn('id', $request->input('cart_id'))
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

        //주문번호
        $order_number = date('Ymdhis');

        return view('order.index')
            ->with('user', $user)
            ->with('carts', $carts)
            ->with('total_price', $total_price)
            ->with('order_number', $order_number);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $authUser = Auth::user();
        $user = User::find($authUser->id);

        //name
        $user->name = $request->input('name');
        $authUser->name = $user->name;

        //tel
        $user->profile->phone = $request->input('phone');
        $user->profile->save();

        //주문번호
        $order_number = $request->input('order-number');

        $carts = Cart::query()
            ->whereIn('id', $request->input('cart-id'))
            ->with([
                'item' => function ($query) {
                    $query->orderBy('id');
                }
            ])
            ->get();

        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->item->price * $cart->quantity;
        }

        $payment = Payment::updateOrCreate(
            [
                'order_number' => $order_number,
                'user_id' => $user->id,
            ],
            [
                'total_price' => $total_price,
                'user_name' => $user->name,
                'user_phone' => $user->profile->phone,
            ]
        );

        foreach ($carts as $cart) {
            Order::updateOrCreate(
                [
                    'item_id' => $cart->item->id,
                    'payment_id' => $payment->id,
                    'order_number' => $order_number
                ],
                [
                    'quantity' => $cart->quantity,
                    'name' => $cart->item->name,
                    'image_file_name' => $cart->item->image_file_name,
                    'price' => $cart->item->price,
                ]
            );
        }

        //cart empty
        Cart::where('user_id', '=', $user->id)->delete();

        return redirect(route('order.show', $order_number));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $payments = Payment::where('user_id', $user->id)
            ->where('order_number', $id)
            ->with([
                'orders' => function ($query) {
                    $query->orderBy('id');
                }
            ])
            ->get();

        return view('order.show')
            ->with('user', $user)
            ->with('payments', $payments);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
