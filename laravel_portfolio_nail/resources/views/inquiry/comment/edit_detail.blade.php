<div class="row border-top pt-3 pb-3">
  <div class="col-md-2">
    {{ $user->name }}
  </div>
  <div class="col-md-8">
    <textarea id="comment-description" class="form-control @error('comment-description') is-invalid @enderror" name="comment-description" required autocomplete="comment-description" autofocus>{{ old('comment-description', $comment->description) }}</textarea>
    @error('comment-description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-block btn-primary"> 
      {{ __('main.qna register') }}
    </button>
  </div>
</div>
