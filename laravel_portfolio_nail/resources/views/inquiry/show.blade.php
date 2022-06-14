@extends('layouts.app')

@section('title')
{{ $inquiry->name }}
@endsection

@section('content')
<div class="container">
  @if ((Auth::check() && $user->isAuthorityManager) || (Auth::check() && $user->id == $inquiry->user_id))
    <div class="row">
      @if (Auth::check() && $user->id == $inquiry->user_id)
        <div class="offset-9">
          <form method="GET" action="{{ route('qna.edit', $inquiry->id) }}" class="p-3" enctype="multipart/form-data">
              <button type="submit" class="btn btn-block btn-primary"> 
                {{ __('main.qna update') }}
              </button>
          </form>
        </div>
      @else
        
      <div class="offset-10"></div>
      @endif
  
      <div>
        <form method="POST" action="{{ route('qna.destroy', $inquiry->id) }}" class="p-3" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="DELETE">
          @csrf
            <button type="submit" class="btn btn-block btn-primary"> 
              {{ __('main.qna destory') }}
            </button>
        </form>
      </div>
    </div>
  @endif
  
  <div class="row">
    <div class="col-8 offset-2 bg-white">
      <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
        <h3>{{ $inquiry->name }}</h3>
      </div>
      <div class="text-right border-bottom pb-2 pt-2 mb-5">
        <span>{{ $inquiry->user->name }}</span>
        <span>[{{ $inquiry->created_at->format('Y/n/j H:i') }}]</span>
      </div>

      <div class="my-3" style="min-height: 300px;">
        {!! nl2br(e($inquiry->description)) !!}
      </div>
    </div>
  </div>

  @include('inquiry.comment.index', [
          'inquiry' => $inquiry,
          'comments' => $comments,
        ])
    
</div>


@endsection
