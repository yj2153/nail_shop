@extends('layouts.app')

@section('title')
{{ __('main.qna title') }}
@endsection

@section('content')
<div class="container">
  <div class="text-center border-bottom pb-3 mb-3">
    <h3>{{ __('main.qna title') }}</h3>
  </div>

  <div class="col-md-12 text-center">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col" style="width:70px;">
            {{ __('main.qna no') }}</th>
          <th scope="col">
            {{ __('main.qna name') }}</th>
          <th scope="col" style="width:100px;">
            {{ __('main.qna user name') }}</th>
          <th scope="col" style="width:140px;">
            {{ __('main.qna date') }}</th>
        </tr>
      </thead>
      <tbody class="table-stripes-row-tbody">
      @foreach($inquiries as $inquiry)
        <tr onclick="location.href='{{ route('qna.show', $inquiry->id) }}'">
          <th scope="row">{{ $inquiry->id }}</th>
          <td class="text-left">{{ $inquiry->name }}</td>
          <td>{{ $inquiry->user->name }}</td>
          <td>{{ $inquiry->created_at->format('Y/n/j H:i') }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center">
      {{ $inquiries->withQueryString()->links() }}
  </div>

  
  <nav class="nav">
    <a class="nav-link text-dark ml-auto" href="{{ route('qna.create') }}">{{ __('main.qna create') }}</a>
</nav>
</div>
@endsection
