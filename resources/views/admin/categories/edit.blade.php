@extends('layouts.dashboard')

@section('content')
	<h1 class="app-page-title">
		{{ @$title }}
		<a href="{{ route('admin.categories.index') }}" class="btn btn-sm app-btn-secondary float-end px-3"><i class="fas fa-angle-double-left"></i></a>
	</h1>
	@include('shared.flash_messages')
  <div class="app-card shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
    	<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" role="form" enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				@include('admin.categories._form')
			</form>
    </div>
  </div>

@endsection