@extends('layouts.app')

@section('title')
{{ __('main.order title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center">
    <h3>{{ __('main.cart title') }}</h3>
  </div>

  <div class="card mb-3">
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
    <div class="col-8 offset-2">
      <button type="submit" class="btn btn-secondary btn-block">{{ number_format($total_price) }}{{ __('main.order pay') }}</button>
        {{-- <button id="payment" type="button" class="btn btn-secondary btn-block">{{ number_format($total_price) }}{{ __('main.order pay') }}</button> --}}
    </div>
  </div>
</div>
@endsection


<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<!-- iamport.payment.js -->
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>

<script>
  var IMP = window.IMP; // 생략 가능
  IMP.init("{{ config('services.iamport.merchant_id') }}"); // 예: imp00000000

  $('#payment').click(()=> {
      // IMP.request_pay(param, callback) 결제창 호출
      IMP.request_pay({ // param
          pg: "{{ config('services.iamport.pg') }}",
          pay_method: "card",
          merchant_uid: "{{ $order_number }}",
          name: "테스트주문",
          amount: {{ $total_price }},
          buyer_email: "{{ $user->email }}",
          buyer_name: "{{ $user->profile->name }}",
      }, function (rsp) { // callback
          if (rsp.success) {
              alert("결제성공1");

              // // jQuery로 HTTP 요청
              $.ajax("/iamport-webhook", {
                  method: "POST",
                  data : {
                      imp_uid: rsp.imp_uid,
                      merchant_uid: rsp.merchant_uid
                  },
                  success : data => {
                  }
              });
          } else {
              alert(rsp.error_msg);
          }
      });
    });

</script>

