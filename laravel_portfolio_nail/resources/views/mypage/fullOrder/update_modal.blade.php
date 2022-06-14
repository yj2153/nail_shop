<!-- Modal -->

<form method="POST" action="{{ route('fullOrder.update', $payment->id) }}">
  <input type="hidden" name="_method" value="PUT">
  @csrf
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.fullOrder status title') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <select id="fullOrder-status" class="custom-select form-control" name="fullOrder-status" required autocomplete="fullOrder-status" autofocus>
            @foreach ($payment->statusArray as $key=>$value)
              <option value="{{ $key }}" {{ $key == $payment->status ? 'selected' : ''}}>
              {{ __('main.'.$value) }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.fullOrder status cancel') }}</button>
          <button type="submit" class="btn btn-primary" >{{ __('main.fullOrder status change') }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
