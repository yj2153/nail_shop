{{-- name --}}
<div class="form-group mt-3">
  <label for="qna-name">{{ __('main.qna name') }}</label>
  <input id="qna-name" type="text" class="form-control @error('qna-name') is-invalid @enderror" name="qna-name" value="{{ old('qna-name', $inquiry->name) }}" required autocomplete="qna-name" autofocus>
  @error('qna-name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

{{-- description --}}
<div class="form-group mt-3">
  <label for="qna-description">{{ __('main.qna description') }}</label>
  <textarea id="qna-description" class="form-control @error('qna-description') is-invalid @enderror" style="height:300px;" name="qna-description" required autocomplete="qna-description" autofocus>{{ old('qna-description', $inquiry->description) }}</textarea>
  @error('qna-description')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

{{-- secret --}}
<div class="form-group mt-3">
  <label for="qna-secret">{{ __('main.qna secret') }}</label>
  <input id="qna-secret" type="text" class="form-control @error('qna-secret') is-invalid @enderror" name="qna-secret" value="{{ old('qna-secret', $inquiry->secret) }}" autocomplete="qna-secret" autofocus>
  @error('qna-secret')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
