{{-- image --}}
<div>{{ __('main.gallery image') }}</div>
<span class="item-image-form image-picker">
  <input type="file" name="gallery-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="gallery-image" />
  <label for="gallery-image" class="d-inline-block">
    @if($gallery->default == 1)
      <img src="/images/IMG_3576.JPG" style="object-fit: over; width: 300px; height: 300px;">  
    @elseif (!empty($gallery->image_file_name))
      <img src="/storage/gallery/{{ $gallery->image_file_name}}" style="object-fit: over; width: 300px; height: 300px;">
    @else
      <img src="/images/item-image-default.png" style="object-fit: over; width: 300px; height: 300px;">  
    @endif
  </label>
</span>
@error('gallery-image')
  <div style="color: #E4342E;" role="alert">
      <strong>{{ $message }}</strong>
  </div>
@enderror

{{-- name --}}
<div class="form-group mt-3">
  <label for="gallery-name">{{ __('main.gallery name') }}</label>
  <input id="gallery-name" type="text" class="form-control @error('gallery-name') is-invalid @enderror" name="gallery-name" value="{{ old('gallery-name', $gallery->name) }}" required autocomplete="gallery-name" autofocus>
  @error('gallery-name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

{{-- description --}}
<div class="form-group mt-3">
  <label for="gallery-description">{{ __('main.gallery description') }}</label>
  <textarea id="gallery-description" class="form-control @error('gallery-description') is-invalid @enderror" name="gallery-description" required autocomplete="gallery-description" autofocus>{{ old('gallery-description', $gallery->description) }}</textarea>
  @error('gallery-description')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
