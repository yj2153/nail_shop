@extends('layouts.app')

@section('title')
{{ __('main.qna title') }}
@endsection

@section('content')
<div class="container">
  <div class="form-group row justify-content-center mt-5" >
    <form method="POST" action="{{ route('secret.store', 1) }}" class="p-5" enctype="multipart/form-data">
      @csrf
      <div class="card" style="width: 700px;">
        <div class="card-body">
          <h5 class="card-title">{{ __('main.qna secret') }}</h5>
          <p class="card-text">
            <input id="secret-password" type="text" class="form-control @error('secret-password') is-invalid @enderror" name="secret-password" value="{{ old('secret-password') }}" autocomplete="secret-password" required autofocus>
            @error('secret-password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message}}</strong>
                </span>
              @enderror
          </p>
          <button type="submit" class="btn btn-block btn-primary"> 
            {{ __('main.secret confim') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
