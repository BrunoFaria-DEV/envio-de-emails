@extends('layouts.dashboard')

@section('content')

	<h1 class="app-page-title">
		{{ @$title }}
	</h1>
	@include('shared.flash_messages')
	<div class="app-card app-card-orders-table shadow-sm p-4 border-left-decoration">
		<div class="app-card-body">
			<div class="table-responsive">
				<table class="table app-table-hover">
					<thead>
						<tr>
							<th scope="col" class="cell">#</th>
							<th scope="col" class="cell">{{ __('Change') }}</th>
							<th scope="col" class="cell">{{ __('Occurred at') }}</th>
							<th scope="col" class="cell">{{ __('IP Address') }}</th>
							<th scope="col" class="cell">{{ __('Operational System') }}</th>
							<th scope="col" class="cell">{{ __('Browser') }}</th>
							<th class="cell"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($audits as $key => $audit)
							<tr>
								<td scope="row" class="cell">{{ $audit->id }}</td>
								<td class="cell"><strong>{{ !$audit->user ? 'Usuário desconhecido' : $audit->user->name }}</strong> {{ strtolower(__('general.' . $audit->event)) }} {{ __('models.' . strtolower(substr($audit->auditable_type, strrpos($audit->auditable_type, '\\') + 1))) }} (id: {{ $audit->auditable_id }})</td>
								<td class="cell">{{ \Carbon\Carbon::parse($audit->created_at)->format('d/m/Y - H:i') }}</td>
								<td class="cell">{{ $audit->ip_address }}</td>
								<td class="cell">{{ platform_name($audit->user_agent) }}</td>
								<td class="cell">{{ browser_name($audit->user_agent) }}</td>
								<td class="cell">
									<a href="{{ route('admin.audit.show', $audit->id) }}" class="btn btn-sm app-btn-secondary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.audit.show', $audit->id) }}" data-large="true" data-title="{{ __('Show') }}"><i class="fas fa-eye text-info"></i> {{ __('Detalhes') }}</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!request()->get('keyword'))
					{{ $audits->links('pagination::bootstrap-4') }}
				@endif
			</div>
		</div>
	</div>

@endsection