@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">
		{{ @$title }}
		<a href="{{ route('admin.customer_accounts.index') }}" class="btn btn-sm app-btn-secondary float-end px-3"><i class="fas fa-angle-double-left"></i></a>
	</h1>
	@include('shared.flash_messages')
  <div class="app-card shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
    	<form action="{{ route('admin.customer_accounts.store') }}" method="POST" role="form" enctype="multipart/form-data">
				@csrf
				@include('admin.customer_accounts._form')
			</form>
    </div>
  </div>

@endsection