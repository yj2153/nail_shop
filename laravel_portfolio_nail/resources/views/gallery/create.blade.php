@extends('layouts.app')

@section('title')
{{ __('main.gallery title') }}
@endsection

@section('javascript')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 offset-2 bg-white">
      <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
        {{ __('main.gallery title') }}
      </div>
      <form method="POST" action="{{ route('gallery.store') }}" class="p-5" enctype="multipart/form-data">
        @csrf

        @include('gallery.edit_detail', [
          'gallery' => $gallery
        ])

        <div class="form-group mb-0 mt-3">
          <button type="submit" class="btn btn-block btn-primary">
             {{ __('main.gallery register') }}
          </button>
        </div>
        
      </form>
    </div>
  </div>
</div>
@endsection
