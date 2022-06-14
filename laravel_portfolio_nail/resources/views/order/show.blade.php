@extends('layouts.app')

@section('title')
{{ __('main.order complete') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center">
    <h3>{{ __('main.order title') }}</h3>
  </div>

  @foreach ($payments as $payment)
  <div class="card mb-3">
    <div class="card-title mt-3 text-center">
      <h2>{{ $payment->order_number }}</h2>
    </div>
    <div class="card-body">
      <h5 class="card-title">
        {{ __('main.profile name') }}:{{ $user->profile->name }}</h5>
      <p class="card-text">{{ __('main.profile phone') }}:{{ $user->profile->phone }}</p>
    </div>
  </div>

  @foreach ($payment->orders as $order)
  <div class="card mb-3" >
    <div class="row no-gutters">
      <div class="col-md-3">
        @if (empty($order->image_file_name))
          <img src="/images/item-image-default.png" style="width: 140px; height: 140px;">
        @else
          <img src="/storage/item/{{ $order->image_file_name}}" class="img-fluid" style="width: 140px; height: 140px;">
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

  <div class="border-top pt-1" style="font-size: 24px;">
    {{ __('main.cart total count') }}：<i class="fas fa-won-sign"></i>{{ number_format($payment->total_price) }}
  </div>
  @endforeach

  <div class="row mt-3 mb-3">
    <div class="col-8 offset-2 text-center">
      <a class="navbar-brand" href="{{ route('item.index') }}">
        <button class="btn btn-primary btn-block">{{ __('main.order main') }}</button>
    </a>
  </div>
</div>
@endsection

