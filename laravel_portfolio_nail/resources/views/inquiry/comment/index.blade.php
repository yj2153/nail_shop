<div class="row">
  <div class="col-8 offset-2 bg-white">
    @foreach ($comments as $comment)
      @if(!empty(session('comment_edit')) && __(session('comment_edit')) == __($comment->id))
        <form method="POST" action="{{ route('comment.update', [$inquiry->id, $comment->id]) }}">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="comment_id" value="{{ $comment->id }}">
          <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
          @csrf
          
          @include('inquiry.comment.edit_detail', [
            'user' => $user,
            'comment' => $comment
          ])

        </form>
      @else
        <div class="row border-top pt-3 pb-3">
          <div class="col-sm-2 align-middle">
            {{ $comment->user->name }}
          </div>
          <div class="col-sm-7 align-middle">
            {{ $comment->description }}
          </div>
          <div class="col-sm-3 text-right">
            @if(empty(session('comment_edit')))
              @if ((Auth::check() && $user->isAuthorityManager) || (Auth::check() && $user->id == $comment->user_id))
                @if(Auth::check() && $user->id == $comment->user_id)
                  <form method="GET" action="{{ route('comment.edit', [$inquiry->id, $comment->id]) }}" class="d-inline ">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <button type="submit" class="btn btn-link text-dark pt-0 pb-0 pr-0"> 
                      {{ __('main.qna update') }}
                    </button>
                  </form>
                @endif

                <form method="POST" action="{{ route('comment.destroy',  [$inquiry->id, $comment->id]) }}" class="d-inline ">
                  <input type="hidden" name="_method" value="DELETE">
                  @csrf
                    <button type="submit" class="btn btn-link text-dark pt-0 pb-0"> 
                      {{ __('main.qna destory') }}
                    </button>
                </form>
              @endif
            @endif
          </div>
        </div>
      @endif
    @endforeach

    @if(Auth::check() && empty(session('comment_edit')))
      <form method="POST" action="{{ route('comment.store', $inquiry->id) }}">
        <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
        @csrf
        
        @include('inquiry.comment.edit_detail', [
          'user' => $user,
          'comment' => $newComment,
        ])

      </form>
    @endif
  </div>
</div>
