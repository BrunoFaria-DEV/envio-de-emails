@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">
		{{ @$title }}
		<a href="{{ route('admin.roles.create') }}" class="btn btn-sm app-btn-secondary float-end px-3" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('New') }}"><i class="fas fa-plus text-primary"></i></a>
	</h1>
	@include('shared.flash_messages')
  <div class="app-card app-card-orders-table shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
    	<div class="table-responsive">
    		<table class="table app-table-hover">
    			<thead>
    				<tr>
    					<th scope="col" class="cell">#</th>
    					<th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.name')) }}</th>
    					<th colspan="2" class="cell"></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($roles as $key => $role)
    					<tr>
    						<td scope="row" class="cell">{{ $role->id }}</td>
    						<td class="cell">{{ $role->name }}</td>
    						<td class="cell">
									<a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm app-btn-secondary"><i class="fas fa-edit text-warning"></i> {{ __('Editar') }}</a>
								</td>
								<td class="cell">
									<button type="button" class="btn btn-sm app-btn-secondary delete" data-bs-toggle="modal" data-bs-target="#modal-delete" data-url="{{ route('admin.roles.destroy', $role->id) }}"><i class="fas fa-trash-alt text-danger"></i> {{ __('Deletar') }}</button>
								</td>
    					</tr>
    				@endforeach
    			</tbody>
    		</table>
    		@if(!request()->get('keyword'))
					{{ $roles->links('pagination::bootstrap-4') }}
				@endif
    	</div>
    </div>
  </div>

@endsection