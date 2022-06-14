@extends('layouts.app')

@section('title')
{{ __('main.order title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center">
    <h3>{{ __('main.order title') }}</h3>
  </div>

  <div class="card mb-3">
    <div class="card-title mt-3 text-center">
      <h2>{{ $order_number }}</h2>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ $user->profile->name }}</h5>
      <p class="card-text">{{ $user->profile->phone }}</p>
    </div>
  </div>

  @foreach ($carts as $cart)
  <div class="card mb-3" >
    <div class="row no-gutters">
      <div class="col-md-3">
        @if (empty($cart->item->image_file_name))
          <img src="/images/item-image-default copy.png" style="height: 140px;">  
        @else
          <img src="/storage/item-images/{{ $cart->item->image_file_name}}" class="img-fluid" style="height: 140px;">
        @endif
      </div>
      <div class="col-md-7">
        <div class="card-body">
          <p class="card-title font-weight-bold">{{ $cart->item->name }}</p>
          <p class="card-text">
            <div class="row">
              <div class="col-4">
                <span>{{ $cart->quantity }}</span><span class="font-weight-bold">{{ __('main.cart count') }}</span>
              </div>
              <div class="col-5">
                <i class="fas fa-won-sign"></i>
                <span class="ml-1">{{number_format($cart->item->price)}}</span>
              </div>
            </div>
          </p>
        </div>
      </div>
  </div>
</div>
  @endforeach

  <div class="border-top pt-1" style="font-size: 24px;">
    {{ __('main.cart total count') }}：<i class="fas fa-won-sign"></i>{{ number_format($total_price) }}
  </div>

  <div class="row mt-3 mb-3">
    <div class="col-8 offset-2 text-center">
      <a class="navbar-brand" href="{{ route('item.index') }}">
        <button class="btn btn-secondary btn-block">{{ __('main.order main') }}</button>
    </a>
  </div>
</div>
@endsection

