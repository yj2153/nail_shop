@extends('layouts.app')

@section('title')
{{ __('main.qna title') }}
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 offset-2 bg-white">
      <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
        {{ __('main.qna title') }}
      </div>
      <form method="POST" action="{{ route('qna.update', $inquiry->id) }}" class="p-5" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf

        @include('inquiry.edit_detail', [
          'inquiry' => $inquiry
        ])

        <div class="form-group mb-0 mt-3">
          <button type="submit" class="btn btn-block btn-primary">
             {{ __('main.qna register') }}
          </button>
        </div>
        
      </form>
    </div>
  </div>
</div>
@endsection
