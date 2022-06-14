@extends('layouts.app')

@section('title')
{{ __('main.gallery title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center border-bottom pb-3 mb-3">
    <h3>{{ __('main.gallery title') }}</h3>
  </div>

  <div class="row">
    @foreach ($gallerys as $gallery)
    <a href="{{ route('gallery.show', $gallery->id) }}" class="col-lg-4 col-md-5">
      <div class="card mb-3 text-dark" style="width: 250px;">
        @if($gallery->default == 1)
          <img src="/images/IMG_3576.JPG" style="height: 250px;">   
        @elseif (empty($gallery->image_file_name))
          <img src="/images/item-image-default.png" style="height: 250px;">  
        @else
          <img src="/storage/gallery/{{ $gallery->image_file_name}}" class="card-img" style="height: 250px;">  
        @endif
        <div class="card-body">
            <p class="card-title">{{ $gallery->name }}</p>
        </div>
      </div>
    </a>
    @endforeach
  </div>

  <div class="d-flex justify-content-center">
      {{ $gallerys->withQueryString()->links() }}
  </div>
</div>
@endsection
