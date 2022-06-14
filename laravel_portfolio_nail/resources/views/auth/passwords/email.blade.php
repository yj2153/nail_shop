@extends('layouts.app_only_content')

@section('title')
{{ __('main.Reset Passwordt') }}
@endsection

@section('content')
<div class="">
    <div class="row justify-content-center" style="width: 700px;">
        <div class="col-md-8">
            <div class="card">
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px"> {{ __('main.Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
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

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary pb-2 pt-2" style="width:90%">
                                    {{ __('main.Send Password Reset Link') }}
                                </button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
