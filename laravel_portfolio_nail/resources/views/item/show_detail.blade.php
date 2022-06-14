<div class="font-weight-bold text-center border-bottom pb-3 pt-3 mb-5" style="font-size: 24px">
  <h3>{{ $item->name }}</h3>
</div>

<div class="row text-center">
  <div class="col-12">
      @if($item->default == 1)
        <img src="/images/item_30.png" style="object-fit: over; width: 300px; height: 300px;"> 
      @elseif (empty($item->image_file_name))
        <img src="/images/item-image-default.png" style="object-fit: over; width: 300px; height: 300px;"> 
      @else
        <img class="card-img-top" src="/storage/item/{{ $item->image_file_name }}" style="object-fit: over; width: 300px; height: 300px;">  
      @endif
  </div>
</div>
<div class="row">
  <div class="col-8 offset-2 text-center">
    {{$item->secondaryCategory->primaryCategory->name}} / {{$item->secondaryCategory->name}}
  </div>
</div>

<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: :20px;">
  <i class="fas fa-won-sign"></i>
  <span class="ml-1">{{ number_format($item->price) }}</span>
</div>
