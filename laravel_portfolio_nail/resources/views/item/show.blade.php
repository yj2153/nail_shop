@extends('layouts.app')

@section('title')
{{ $item->name }}
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 offset-2">
      @if(session('status'))
        <script>
          window.onload=function(){
            if(confirm("{{ __('main.'.session('status')) }}")){
              window.location.href = "{{route('cart.index')}}";
            }
          }
        </script>
      @endif
    </div>
  </div>

  <div class="row">
      <div class="col-8 offset-2 bg-white">
        @include('item.show_detail', [
          'item' => $item
        ])

        @if (Auth::check() && $user->isAuthorityManager)
        <form method="POST" action="{{ route('item.destroy', $item->id) }}" class="p-3" >
          <input type="hidden" name="_method" value="DELETE">
          @csrf
          <div class="row">
            <div class="col-8 offset-2">
              <button type="submit" class="btn btn-block btn-danger"> 
                {{ __('main.item destory') }}
              </button>
            </div>
          </div>
        </form>
        @endif

        <form method="POST" action="{{ route('cart.update', $item->id) }}" class="p-3" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PUT">
          @csrf

          <div class="form-group row">
            <div class="col-8 offset-2">
              <input id="item-quantity" type="number" class="form-control @error('item-quantity') is-invalid @enderror" name="item-quantity" value="{{ old('item-quantity', 1) }}" required autocomplete="item-quantity" autofocus>
              @error('item-quantity')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message}}</strong>
                </span>
              @enderror
            </div>
          </div>

            <div class="row">
              <div class="col-8 offset-2">
                <button type="submit" class="btn btn-block btn-primary"> 
                  {{ __('main.cart create') }}
                </button>
              </div>
            </div>
        </form>
        <div class="my-3">
          {!! nl2br(e($item->description)) !!}</div>
      </div>
  </div>
</div>
@endsection
