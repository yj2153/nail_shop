@extends('layouts.app')

@section('title')
    {{ __('main.fullOrder title') }}
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
@endsection

@section('javascript')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/ja.js" defer></script>
<script src="{{ asset('js/fullOrder.js') }}" defer></script>
@endsection

@section('content')

<div class="contatiner">
  <div class="row">
    <div class="col-8 offset-2">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{  __('main.'.session('status')) }}
        </div>
      @endif
    </div>
  </div>

  <div class="col-md-12 mb-3">
    <div class="row">
      <div class="col-md-8">
        <form class="form-inline" method="GET" action="{{ route('fullOrder.index') }}">
          <div class="input-group">
              <div class="input-group-prepend">
                <div>
                  <input id="startDate" data-provide="datepicker" class="form-control datepicker js-start-date @error('startDate') is-invalid @enderror" type="datetime"
                placeholder="YYYY/MM/DD" name="startDate" value="{{ old('startDate', $defaults['startDate']) }}" dusk='datepicker_first'>
                @error('startDate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message}}</strong>
                  </span>
                @enderror
                </div>
                
                <div class="pr-2 pl-2 d-flex justify-content-center align-items-center">
                  〜
                </div>

                <div>
                  <input id="endDate" data-provide="datepicker" class="form-control datepicker js-end-date @error('endDate') is-invalid @enderror" type="datetime" placeholder="YYYY/MM/DD"
                    name="endDate" value="{{ old('endDate', $defaults['endDate']) }}" dusk='datepicker_last'>
                    @error('endDate')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message}}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              <div class="ml-2">
                  <button type="submit" class="btn btn-outline-dark">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
          </div>
        </form>
      </div>
      <div class="col-md-4 text-right">
        <form method="POST" action="{{ route('fullOrder.store') }}" >
          @csrf
          <input id="hiddenStartDate" type="datetime" class="d-none" name="startDate" value="{{ old('startDate', $defaults['startDate']) }}">
          <input id="hiddenEndDate" type="datetime" class="d-none" name="endDate" value="{{ old('endDate', $defaults['endDate']) }}">
          <button type='submit' class="btn btn-primary">{{ __('main.fullOrder csv') }}</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-12 text-center">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">
            {{ __('main.fullOrder no') }}</th>
          <th scope="col">
            {{ __('main.fullOrder user name') }}</th>
          <th scope="col">
            {{ __('main.fullOrder user phone') }}</th>
          <th scope="col">
            {{ __('main.fullOrder order number') }}</th>
          <th scope="col">
            {{ __('main.fullOrder order item') }}</th>
          <th scope="col">
            {{ __('main.fullOrder order status') }}</th>
        </tr>
      </thead>
      <tbody class="table-stripes-row-tbody">
      @foreach($payments as $payment)
        <tr>
          <td class="align-middle" rowspan="{{ count($payment->orders) }}">{{ $loop->iteration }}</td>
          <td class="align-middle" rowspan="{{ count($payment->orders) }}">{{ $payment->user_name }}</td>
          <td class="align-middle" rowspan="{{ count($payment->orders) }}">{{ $payment->user_phone }}</td>
          <td class="align-middle" rowspan="{{ count($payment->orders) }}">{{ $payment->order_number }}</td>
          @foreach($payment->orders as $order)
            @if ($loop->first)
            <td>{{ $order->name }}</td>
            @endif
          @endforeach
          <td class="align-middle" rowspan="{{ count($payment->orders) }}">
            @if($payment->status != '9')
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                {{ __('main.'.$payment->statusName) }}
              </button>
            @else
              {{ __('main.'.$payment->statusName) }}
            @endif

            @include('mypage.fullOrder.update_modal', [
              'payment' => $payment
            ])
          </td>
        </tr>
        @if (count($payment->orders) > 1)
          @foreach($payment->orders as $order)
            @if ($loop->first)
              @continue
            @else
              <tr>
                <td>{{ $order->name }}</td>
              </tr>
            @endif
          @endforeach
        @endif
      @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection
