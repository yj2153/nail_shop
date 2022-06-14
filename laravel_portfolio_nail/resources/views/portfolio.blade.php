<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <div class="container">
        <div class="form-group row justify-content-center mt-5" >
          <div class="card" style="width: 700px;">
            <div class="card-body">
              <h5 class="card-title">{{ __('portfolio.name') }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ __('portfolio.email') }}</h6>
              <p class="card-text">
                {{ __('portfolio.info') }}</p>
              <a href="{{ route('main.index') }}" class="card-link">portfolio</a>
            </div>
          </div>
        </div>

        <div class="form-group row justify-content-center mt-3" >
          <div class="card" style="width: 700px;">
            <div class="card-body">
              <h5 class="card-title">{{ __('portfolio.site title') }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ __('portfolio.site info') }}</h6>
              <p class="card-text">
                {!! __('portfolio.site description') !!}
              </p>
            </div>
          </div>
        </div>

        <div class="form-group row justify-content-center mt-3 mb-5" >
          <div class="card" style="width: 700px;">
            <div class="card-body">
              <h5 class="card-title">{{ __('portfolio.db title') }}</h5>
              <p class="card-text">
                {{ __('portfolio.db info') }}</p>
              <a href="https://docs.google.com/spreadsheets/d/1V8xJiUykzti6WKWpMlzRzQFIcSJ68SO3oJUu5Pbi9ZU/edit?usp=sharing" class="card-link">{{ __('portfolio.db link') }}</a>
            </div>

            <div class="card-body">
              <h5 class="card-title">{{ __('portfolio.source title') }}</h5>
              <p class="card-text">
              <a href="https://github.com/yj2153/nailshop" class="card-link">{{ __('portfolio.source link') }}</a>
            </div> 
          </div>
        </div>

      </div>
    </div>
</body>
</html>

