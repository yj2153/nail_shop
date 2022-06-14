<!-- Modal -->
<form method="POST" action="{{ route('fullcalendar.store') }}">
  <input id="calendar-id" type="hidden" name="calendar-id" value="">
  <input id="calendar-ymd" type="hidden" name="calendar-ymd" value="">
  @csrf
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.calendar event title') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
          </div>
          {{-- title --}}
          <div class="form-group row">
            <label for="calendar-title" class="col-sm-2 col-form-label">
              {{ __('main.calendar model title') }}
            </label>
            <div class="col-sm-10">
              <input id="calendar-title" type="text" class="form-control" name="calendar-title" value="{{ old('calendar-title') }}" required autocomplete="calendar-title" autofocus>
              <span id="calendar-title-msg" class="invalid-feedback" role="alert">
                <strong></strong>
              </span>
            </div>
          </div>

          {{-- user --}}
          <div class="form-group row">
            <label for="calendar-user" class="col-sm-2 col-form-label">
              {{ __('main.calendar model user') }}
            </label>
            <div class="col-sm-10">
              <select id="calendar-user" class="custom-select form-control" name="calendar-user" required autocomplete="calendar-user" autofocus>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}" >
                  {{ $user->name }}
                  </option>
                @endforeach
              </select>
              <span id="calendar-user-msg" class="invalid-feedback" role="alert">
                <strong></strong>
              </span>
            </div>
          </div>

          {{-- start --}}
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              {{ __('main.calendar model start') }}
            </label>
            <div class="col-sm-5">
              <select id="calendar-start-hour" class="custom-select form-control" name="calendar-start-hour" required autocomplete="calendar-start-hour" autofocus>
                @foreach ($hours as $hour)
                  <option value="{{ $hour }}" {{ $hour == old('calendar-start-hour') ? 'selected' : ''}}>
                    {{ $hour }}
                  </option>
                @endforeach
              </select>
              <span id="calendar-start-hour-msg" class="invalid-feedback" role="alert">
                <strong></strong>
              </span>
            </div>
            <div class="col-sm-5">
              <select id="calendar-start-minute" class="custom-select form-control" name="calendar-start-minute" required autocomplete="calendar-start-minute" autofocus>
                @foreach ($minutes as $minute)
                  <option value="{{ $minute }}" {{ $minute == old('calendar-start-minute') ? 'selected' : ''}}>
                    {{ $minute }}
                  </option>
                @endforeach
              </select>
              <span id="calendar-start-minute-msg" class="invalid-feedback" role="alert">
                <strong></strong>
              </span>
            </div>
          </div>

          {{-- end --}}
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              {{ __('main.calendar model end') }}
            </label>
            <div class="col-sm-5">
              <select id="calendar-end-hour" class="custom-select form-control" name="calendar-end-hour" required autocomplete="calendar-end-hour" autofocus>
                @foreach ($hours as $hour)
                  <option value="{{ $hour }}" {{ $hour == old('calendar-end-hour') ? 'selected' : ''}}>
                    {{ $hour }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-5">
              <select id="calendar-end-minute" class="custom-select form-control" name="calendar-end-minute" required autocomplete="calendar-end-minute" autofocus>
                @foreach ($minutes as $minute)
                  <option value="{{ $minute }}" {{ $minute == old('calendar-end-minute') ? 'selected' : ''}}>
                    {{ $minute }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- color --}}
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              {{ __('main.calendar model color') }}
            </label>
            <div class="col-sm-10">
              <select id="calendar-color" class="custom-select form-control" name="calendar-color" required autocomplete="calendar-color" autofocus>
                @foreach ($colors as $color)
                  <option value="{{ $color }}" {{ $color == old('calendar-color') ? 'selected' : ''}}>
                    {{ $color }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.calendar event cancel') }}</button>
          <button id="update-btn" type="button" class="btn btn-primary">{{ __('main.calendar event update') }}</button>
          <button id="delete-btn" type="button" class="btn btn-danger">{{ __('main.calendar event delete') }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
