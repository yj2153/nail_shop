@extends('layouts.app')

@section('title')
{{ __('main.order title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center">
    <h3>{{ __('main.cart title') }}</h3>
  </div>

    <form method="POST" action="{{ route('order.store') }}" class="p-5">
    @csrf
    <input type="hidden" name="order-number" value="{{ $order_number }}">

    <div class="card mb-3">
      <div class="card-body">
          <div class="form-group">
            <label for="name">{{ __('main.profile name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone">{{ __('main.profile phone') }}</label>
            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->profile->phone) }}" required autocomplete="phone" autofocus>
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
      </div>
    </div>

    @foreach ($carts as $cart)
    <input type="hidden" name="cart-id[]" value="{{ $cart->id }}">
    <div class="card mb-3" >
      <div class="row no-gutters">
        <div class="col-md-3">
          @if (empty($cart->item->image_file_name))
            <img src="/images/item-image-default.png" style="width: 140px; height: 140px;">  
          @else
            <img src="/storage/item/{{ $cart->item->image_file_name }}" class="img-fluid" style="width: 140px; height: 140px;">
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
      <div class="col-8 offset-2">
        <button type="submit" class="btn btn-primary btn-block">
            {{ number_format($total_price) }}{{ __('main.order pay') }}
        </button>
      </div>
    </div>
  </form>
</div>
@endsection

