@extends('layouts.app')

@section('title')
{{ $gallery->name }}
@endsection

@section('content')
<div class="container">
  @if (Auth::check() && $user->isAuthorityManager)
  <div class="row">
    <div class="offset-9">
      <form method="GET" action="{{ route('gallery.edit', $gallery->id) }}" class="p-3" enctype="multipart/form-data">
          <button type="submit" class="btn btn-block btn-primary"> 
            {{ __('main.gallery update') }}
          </button>
      </form>
    </div>

    <div >
      <form method="POST" action="{{ route('gallery.destroy', $gallery->id) }}" class="p-3" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
          <button type="submit" class="btn btn-block btn-primary"> 
            {{ __('main.gallery destory') }}
          </button>
      </form>
    </div>
  </div>
  @endif

  <div class="row">
      <div class="col-8 offset-2 bg-white">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3 mb-5" style="font-size: 24px">
          <h3>{{ $gallery->name }}</h3>
        </div>

        <div class="row text-center">
          <div class="col-12">
              @if($gallery->default == 1)
                <img src="/images/IMG_3576.JPG" style="object-fit: over; width: 300px; height: 300px;">    
              @elseif (empty($gallery->image_file_name))
                <img src="/images/item-image-default.png" style="object-fit: over; width: 300px; height: 300px;">    
              @else
                <img class="card-img-top" src="/storage/gallery/{{ $gallery->image_file_name }}" style="object-fit: over; width: 300px; height: 300px;">  
              @endif
          </div>
        </div>

        <div class="my-3">
          {!! nl2br(e($gallery->description)) !!}</div>
        </div>
    </div>

    <div class="row mt-3">
      <div class="col-8 offset-2 bg-white pb-3 pt-3">
        <div class="font-weight-bold border-bottom pb-1 pb-1" >
          <b>{{ __('main.gallery list') }}</b>
        </div>

        <div class="list-group">
          @if(!empty($gallery_prev))
            <a href="{{ route('gallery.show', $gallery_prev->id) }}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <b>{{ $gallery_prev->name }}</b>
                <small>{{ __('main.gallery list prev') }}</small>
              </div>
            </a>
          @endif
          @if(!empty($gallery_next))
          <a href="{{ route('gallery.show', $gallery_next->id) }}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <b>{{ $gallery_next->name }}</b>
              <small>{{ __('main.gallery list next') }}</small>
            </div>
          </a>
          @endif
        </div>
    </div>
  </div>
</div>
@endsection
