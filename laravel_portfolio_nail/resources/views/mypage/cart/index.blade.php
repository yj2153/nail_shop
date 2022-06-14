@extends('layouts.app')

@section('title')
{{ __('main.cart title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center border-bottom pb-3 mb-3">
    <h3>{{ __('main.cart title') }}</h3>
  </div>

  @if(count($carts) > 0)
  @foreach ($carts as $cart)

  <div class="card mb-3" >
    <div class="row no-gutters">
      <div class="col-md-3">
        @if (empty($cart->item->image_file_name))
          <img src="/images/item-image-default.png" style="width:140px; height:140px;">
        @else
          <img src="/storage/item/{{ $cart->item->image_file_name}}" class="img-fluid" style="width:140px; height:140px;">
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
        <a href="{{ route('item.show', [$cart->item->id]) }}" class="stretched-link"></a>
      </div>
      <div class="col-md-2 text-right">
        <div class="card-body">
          <form method="POST" action="{{ route('cart.destroy', $cart->id) }}">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
                <button type="submit">
                  <i class='fas fa-trash-alt'></i>
                </button>
          </form>
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
      <form method="GET" action="{{ route('order.index') }}">
          @csrf
            @foreach ($carts as $cart)
              <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
            @endforeach

            <button type="submit" class="btn btn-primary btn-block">
              {{ __('main.cart pay') }}
            </button>
      </form>
    </div>
  </div>
  @else
  <div>
    {{ __('main.cart empty') }}
  </div>
  @endif
</div>
@endsection

