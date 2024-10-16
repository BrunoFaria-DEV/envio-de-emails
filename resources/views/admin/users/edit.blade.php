@extends('layouts.dashboard')

@section('content')
	<h1 class="app-page-title">
		{{ @$title }}

		@if(auth()->user()->hasRole('super-admin|admin|suporte'))
		<a href="{{ route('admin.users.index') }}" class="btn btn-sm app-btn-secondary float-end px-3"><i class="fas fa-angle-double-left"></i></a>
		@endif

		@if(auth()->user()->hasRole('cliente'))
		<a href="{{ route('admin.home') }}" class="btn btn-sm app-btn-secondary float-end px-3"><i class="fas fa-angle-double-left"></i></a>
		@endif

	</h1>
	@include('shared.flash_messages')
  <div class="app-card shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
    	<form action="{{ route('admin.users.update', $user->id) }}" method="POST" role="form" enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				@include('admin.users._form')
			</form>
    </div>
  </div>

@endsection