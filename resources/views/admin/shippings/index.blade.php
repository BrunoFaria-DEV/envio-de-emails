{{-- @dd($shippings) --}}
@extends('layouts.dashboard')

@section('content')

    <h1 class="app-page-title">

        {{ $title }}

        <a href="{{ route('admin.shippings.create') }}" class="btn btn-sm app-btn-secondary float-end px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Nova Empresa"><i class="fas fa-plus"></i></a>

        @if(!request()->has('data_inicial') && !request()->has('data_final'))
            <a href="{{ route('admin.shippings.csv') }}" class="btn btn-sm btn-success float-end px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV"><i class="fas fa-table text-primary"></i></a>
        @elseif(!request()->has('data_inicial') || !request()->has('data_final'))

            @if(!request()->has('data_inicial') && request()->has('data_final'))
                <a href="{{ route('admin.shippings.csv') }}?data_inicial={{ request()->get('data_inicial') }}" class="btn btn-sm btn-success float-end px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV"><i class="fas fa-table text-primary"></i></a>
            @else
                <a href="{{ route('admin.shippings.csv') }}?data_final={{ request()->get('data_final') }}" class="btn btn-sm btn-success float-end px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV"><i class="fas fa-table text-primary"></i></a>
            @endif

        @else
            <a href="{{ route('admin.shippings.csv') }}?data_final={{ request()->get('data_final') }}&data_inicial={{ request()->get('data_inicial') }}" class="btn btn-sm btn-success float-end px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV"><i class="fas fa-table text-primary"></i></a>
        @endif

    </h1>

    <form action="{{ route('admin.shippings.index') }}" method="GET" role="form">
        <div class="row flex-end mb-3">
            <div class="col-md-2">
                <label class="form-label">Data Inicial</label>
                <input type="date" name="data_inicial" class="form-control"
                    value="{{ old('data_inicial', request()->get('data_inicial')) ?? '' }}" />
            </div>
            <div class="col-md-2">
                <label class="form-label">Data Final</label>
                <input type="date" name="data_final" class="form-control"
                    value="{{ old('data_final', request()->get('data_final')) ?? date('Y-m-d') }}" />
            </div>
            <div class="col-md-2 d-grid align-content-end">
                <button type="submit" class="btn app-btn-primary" role="button">Consultar</button>
            </div>
        </div>
    </form>

    @include('shared.flash_messages')
        <div class="app-card app-card-orders-table border-left-decoration">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="cell">#</th>
                                <th scope="col" class="cell">Conta</th>
                                <th scope="col" class="cell">Tipo de Envio</th>
                                <th scope="col" class="cell">Data de Envio</th>
                                <th scope="col" class="cell">Status do Envio</th>
                                <th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.created_at')) }}</th>
                                <th colspan="3" class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippings as $shipping)
                                <tr>
                                    <td scope="row" class="cell">{{ $shipping->id }}</td>
                                    <td class="cell"><h6 class="mb-0 text-sm"> {{ $shipping->customerAccount->name }} </h6></td>
                                    <td class="cell"><h6 class="mb-0 text-sm"> {{ \App\Enums\ShippingType::getDescription($shipping->shipping_type) }} </h6></td>
                                    <td class="cell">{{ \Carbon\Carbon::parse($shipping->shipping_date)->format('d/m/Y - H:i') }}</td>
                                    <td class="cell"><h6 class="mb-0 text-sm"> {{ \App\Enums\ShippingStatus::getDescription($shipping->status) }} </h6></td>
                                    <td class="cell">{{ \Carbon\Carbon::parse($shipping->created_at)->format('d/m/Y - H:i') }}</td>
                                    <td class="cell cell-custom">
                                        <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Detalhes') }}</a>
                                    </td>
                                    <td class="cell cell-custom">
                                        <a href="{{ route('admin.shippings.edit', $shipping->id) }}" class="btn btn-primary">{{ __('Editar') }}</a>
                                    </td>
                                    <td class="cell cell-custom">
                                        <button type="button" data-url="{{ route('admin.shippings.destroy', $shipping->id) }}"data-bs-toggle="modal" data-bs-target="#modal-delete" class="btn btn-danger delete">{{ __('Deletar') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(!request()->get('keyword'))
					    {{ $shippings->links('pagination::bootstrap-5') }}
				    @endif
                </div>
            </div>
        </div>

@endsection
