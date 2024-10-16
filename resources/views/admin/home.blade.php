@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">{{ $title }}</h1>
  <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
      <div class="app-card-body p-3 p-lg-4">
        <h3 class="mb-5">{{ Str::ucfirst(__('general.welcome')) }}, {{ auth()->user()->name }}</h3>
      </div>
    </div>
  </div>

@endsection