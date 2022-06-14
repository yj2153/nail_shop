@extends('layouts.app')

@section('title')
    {{ __('main.bought title') }}
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-10 offset-1 bg-white">
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3 mb-5" style="font-size: 24px">
                    {{ __('main.bought title') }}
                </div>

                    @foreach ($payments as $payment)
                    <div class="border-top mb-5">
                        <div >
                            <span class="font-weight-bold" style="font-size:20px;">{{ $payment->order_number }}</span>
                        </div>
                        <table style="width: 100%;">
                            <tr>
                                <td class="align-bottom">
                                    <i class="far fa-clock"></i>
                                    <span calss="">{{$payment->created_at->format('Y년n월j일 H:i')}}</span>
                                </td>
                                <td class="text-right" style="font-size:20px;">
                                    {{ __('main.cart total count') }}：<i class="fas fa-won-sign"></i>{{ number_format($payment->total_price) }}
                                </td>
                            </tr>
                          </table>
                        @foreach ($payment->orders as $order)
                            <div class="card mb-3" >
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        @if (empty($order->image_file_name))
                                        <img src="/images/item-image-default.png" style="height: 140px;">  
                                        @else
                                        <img src="/storage/item/{{ $order->image_file_name}}" class="img-fluid" style="height: 140px;">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <p class="card-title font-weight-bold">{{ $order->name }}</p>
                                            <p class="card-text">
                                                <div class="row">
                                                <div class="col-4">
                                                    <span>{{ $order->quantity }}</span><span class="font-weight-bold">{{ __('main.cart count') }}</span>
                                                </div>
                                                <div class="col-5">
                                                    <i class="fas fa-won-sign"></i>
                                                    <span class="ml-1">{{number_format($order->price)}}</span>
                                                </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
