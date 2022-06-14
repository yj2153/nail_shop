@extends('layouts.app')

@section('title')
{{ __('main.item title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center border-bottom pb-3 mb-3">
    <h3>{{ __('main.item title') }}</h3>
  </div>

  <div class="row">
    @foreach ($Products as $item)
    <a href="{{ route('item.show', $item->id) }}" class="col-lg-4 col-md-5">
      <div class="card mb-3 text-dark" style="width: 250px;">
        @if($item->default == 1)
        <img src="/images/item_30.png" style="object-fit: over; width: 250px; height: 250px;">     
        @elseif (empty($item->image_file_name))
          <img src="/images/item-image-default.png" style="object-fit: over; width: 250px; height: 250px;">     
        @else
          <img src="/storage/item/{{ $item->image_file_name}}" class="card-img" style="object-fit: over; width: 250px; height: 250px;">
        @endif
        <div class="card-body">
            <p class="card-title">{{ $item->name }}</p>
            <p class="card-text">
              <i class="fas fa-won-sign"></i>
              {{ number_format($item->price) }}</p>
        </div>
      </div>
    </a>
    @endforeach
  </div>

  <div class="d-flex justify-content-center">
      {{ $Products->withQueryString()->links() }}
  </div>
</div>
@endsection
