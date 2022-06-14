@extends('layouts.app_only_content')

@section('title')
{{ __('main.login title') }}
@endsection

@section('content')
<div class="">
    <div class="row justify-content-center" style="width: 700px;">
        <div class="col-md-8">
            <div class="card">
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px"> {{ __('main.login title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-12 col-form-label text-md-left">
                                {{ __('main.login normal user') }}<br/>
                                {{ __('main.login admin user') }}
                            </label>
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('main.auth email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-12 col-form-label text-md-left">
                                {{ __('main.auth password') }}：testtest
                            </label>
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('main.auth password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('main.login remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary pb-2 pt-2" style="width:90%">
                                    {{ __('main.login title') }}
                                </button>
                            </div>
                        </div>
                        
                        @if (Route::has('register'))
                            <div>
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('main.register title') }}
                                </a>
                            </div>
                        @endif

                        @if (Route::has('password.request'))
                            <div>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('main.login forgot your password') }}
                                </a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
