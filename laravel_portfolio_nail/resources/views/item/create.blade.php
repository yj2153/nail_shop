@extends('layouts.app')

@section('title')
{{ __('main.sell title') }}
@endsection

@section('javascript')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 offset-2">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {!! __('main.'.session('status')) !!}
        </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-8 offset-2 bg-white">
      <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
        {{ __('main.sell title') }}
      </div>
      <form method="POST" action="{{ route('item.store') }}" class="p-5" enctype="multipart/form-data">
        @csrf

        {{-- sell image --}}
        <div>{{ __('main.sell image') }}</div>
        <span class="item-image-form image-picker">
          <input type="file" name="sell-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="sell-image" />
          <label for="sell-image" class="d-inline-block">
              <img src="/images/item-image-default.png" style="object-fit: over; width: 300px; height: 300px;">      
          </label>
        </span>
        @error('sell-image')
          <div style="color: #E4342E;" role="alert">
              <strong>{{ $message }}</strong>
          </div>
        @enderror

        {{-- sell name --}}
        <div class="form-group mt-3">
          <label for="sell-name">{{ __('main.sell name') }}</label>
          <input id="sell-name" type="text" class="form-control @error('sell-name') is-invalid @enderror" name="sell-name" value="{{ old('sell-name') }}" required autocomplete="sell-name" autofocus>
          @error('sell-name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        {{-- description --}}
        <div class="form-group mt-3">
          <label for="sell-description">{{ __('main.sell description') }}</label>
          <textarea id="sell-description" class="form-control @error('sell-description') is-invalid @enderror" name="sell-description" required autocomplete="sell-description" autofocus>{{ old('sell-description') }}</textarea>
          @error('sell-description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        {{-- category --}}
        <div class="form-group mt-3">
          <label for="sell-category">{{ __('main.sell category') }}</label>
          <select id="sell-category" class="custom-select form-control @error('sell-category') is-invalid @enderror" name="sell-category" required autocomplete="sell-category" autofocus>
            @foreach ($categories as $category)
              <optgroup label="{{$category->name}}">
                @foreach($category->secondaryCategories as $secondary)
                  <option value="{{ $secondary->id }}" {{ old('sell-category') == $secondary->id ? 'selected' : ''}}>
                    {{ $secondary->name }}
                  </option>
                @endforeach
              </optgroup>
            @endforeach
          </select>
          @error('sell-category')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

         {{-- sell price --}}
        <div class="form-group mt-3">
          <label for="sell-price">{{ __('main.sell price') }}</label>
          <input id="sell-price" type="number" class="form-control @error('sell-price') is-invalid @enderror" name="sell-price" value="{{ old('sell-price') }}" required autocomplete="sell-price" autofocus>
          @error('sell-price')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mb-0 mt-3">
          <button type="submit" class="btn btn-block btn-primary">
             {{ __('main.sell register') }}
          </button>
        </div>
        
      </form>
    </div>
  </div>
</div>
@endsection
