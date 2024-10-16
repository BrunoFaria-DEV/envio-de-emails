@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">
		{{ @$title }}
		<a href="{{ route('admin.users.create') }}" class="btn btn-sm app-btn-secondary float-end px-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Novo"><i class="fas fa-plus"></i></a>
	</h1>
	@include('shared.flash_messages')
	<div class="app-card app-card-orders-table border-left-decoration">
		<div class="app-card-body">
			<div class="table-responsive">
				<table class="table app-table-hover table-custom table-action">
					<thead>
						<tr>
							<th scope="col" class="cell">#</th>
							<th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.name')) }}/{{ Str::ucfirst(__('validation.attributes.email')) }}</th>
							<th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.created_at')) }}</th>
							<th colspan="3" class="cell"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $user)
							<tr>
								<td scope="row" class="cell">{{ $user->id }}</td>
								<td class="cell d-flex p-2">
									<div>
										<img @if($user->avatar != NULL) src="{{ url("storage/{$user->avatar}") }}" @else src="{{ url("storage/uploads/default/user.png") }}" && null @endif class="me-3 rounded-circle" height="48" width="48" alt="user{{ $user->id }}">
									</div>
									<div class="d-flex flex-column justify-content-center">
										<h6 class="mb-0 text-sm">{{ $user->name }}</h6>
										<p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
									</div>
								</td>
								<td class="cell">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y - H:i') }}</td>
								<td class="cell cell-custom">
									<a href="{{ route('admin.users.show', $user->slug) }}" class="button-view-item show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.users.show', $user->slug) }}" data-large="true" data-title="{{ __('Show') }}">{{ __('Detalhes') }}</a>
								</td>
								<td class="cell cell-custom">
									<a href="{{ route('admin.users.edit', $user->id) }}" class="button-edit-item">{{ __('Editar') }}</a>
								</td>
								@if (!$user->hasRole('super-admin|admin'))
									@role(['super-admin|admin'])
										<td class="cell cell-custom">
											<button type="button" class="button-delete-item delete" data-bs-toggle="modal" data-bs-target="#modal-delete" data-url="{{ route('admin.users.destroy', $user->id) }}">{{ __('Deletar') }}</button>
										</td>
										@if($user->status == 1)
											<td class="cell cell-custom">
												<button type="button" class="button-delete-item banned" data-bs-toggle="modal" data-bs-target="#modal-banned" data-url="{{ route('admin.users.banned', $user->id) }}">{{ __('Suspender') }}</button>
											</td>
										@else
											<td class="cell cell-custom">
												<button type="button" class="button-edit-item active-acount" data-bs-toggle="modal" data-bs-target="#modal-active-acount" data-url="{{ route('admin.users.banned', $user->id) }}">{{ __('Ativar') }}</button>
											</td>
										@endif
									@endrole
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!request()->get('keyword'))
					{{ $users->links('pagination::bootstrap-5') }}
				@endif
			</div>
		</div>
	</div>
@endsection