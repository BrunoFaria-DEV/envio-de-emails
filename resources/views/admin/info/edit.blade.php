@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">{{ @$title }}</h1>
	@include('shared.flash_messages')
  <div class="app-card shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
    	<form action="{{ route('admin.info.update', $info->id) }}" method="POST" role="form">
				@method('PATCH')
				@csrf
				@include('admin.info._form')
			</form>
    </div>
  </div>

@endsection