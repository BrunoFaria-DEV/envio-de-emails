{{-- @dd($customers) --}}
@extends('layouts.dashboard')

@section('content')

<h1 class="app-page-title">
    {{ $title }}
    <a href="{{ route('admin.customers.create') }}" class="btn btn-sm app-btn-secondary float-end px-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Nova Empresa"><i class="fas fa-plus"></i></a>
</h1>
@include('shared.flash_messages')

<div class="app-card app-card-orders-table border-left-decoration">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="cell">#</th>
                        <th scope="col" class="cell"> Nome/Razão Social</th>
                        <th scope="col" class="cell"> Email</th>
                        <th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.created_at')) }}</th>
                        <th colspan="3" class="cell"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td scope="row" class="cell">{{ $customer->id }}</td>
                        <td class="cell"><h6 class="mb-0 text-sm"> {{ $customer->type == 1 ? $customer->fantasy_name : $customer->name }} </h6></td>
                        <td class="cell">{{ $customer->email ?? 'não cadastrado' }} </td>
                        <td class="cell">{{ \Carbon\Carbon::parse($customer->created_at)->format('d/m/Y - H:i') }}</td>
                        <td class="cell cell-custom">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.customers.show', $customer->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Detalhes') }}</a>
                        </td>
                        <td class="cell cell-custom">
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary">{{ __('Editar') }}</a>
                        </td>
                        <td class="cell cell-custom">
                            <button type="button" data-url="{{ route('admin.customers.destroy', $customer->id) }}"data-bs-toggle="modal" data-bs-target="#modal-delete" class="btn btn-danger delete">{{ __('Deletar') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection