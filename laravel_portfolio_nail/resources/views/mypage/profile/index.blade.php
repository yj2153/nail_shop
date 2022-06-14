@extends('layouts.app')

@section('title')
{{ __('main.profile title') }}
@endsection

@section('javascript')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endsection

@section('content')
<div class="contatiner">
  <div class="row">
    <div class="col-8 offset-2">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {!!  __('main.'.session('status')) !!}
        </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-8 offset-2 bg-white">
      <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
        {{ __('main.profile Edit') }}
      </div>

      <form method="POST" action="{{ route('profile.store') }}" class="p-5" enctype="multipart/form-data">
        @csrf

        <span class="avatar-form image-picker">
          <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
          <label for="avatar" class="d-inline-block">
            @if (!empty($user->profile->avatar_file_name))
            <img src="/storage/avatars/{{ $user->profile->avatar_file_name}}" class="rounded-circle" style="object-fit: over; width: 200px; height: 200px;">
            @else
              <img src="/images/item-image-default.png" class="rounded-circle" style="object-fit: over; width: 200px; height: 200px;">      
            @endif
          </label>
        </span>
        
        <div class="form-group mt-3">
          <label for="name">{{ __('main.profile name') }}</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message}}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group mt-3">
          <label for="phone">{{ __('main.profile phone') }}</label>
          <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->profile->phone) }}" required autocomplete="phone" autofocus>
          @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message}}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mb-0 mt-3">
            <button type="submit" class="btn btn-block btn-primary"> 
              {{ __('main.profile save') }}
            </button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
