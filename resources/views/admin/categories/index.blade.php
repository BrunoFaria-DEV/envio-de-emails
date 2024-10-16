@extends('layouts.dashboard')

@section('content')

<h1 class="app-page-title">
    {{ $title }}
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm app-btn-secondary float-end px-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Novo Setor"><i class="fas fa-plus text-primary"></i></a>
</h1>
@include('shared.flash_messages')

<div class="app-card app-card-orders-table shadow-sm p-4 border-left-decoration">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="cell">#</th>
                        <th scope="col" class="cell">Setores</th>
                        <th scope="col" class="cell">{{ Str::ucfirst(__('validation.attributes.created_at')) }}</th>
                        <th colspan="2" class="cell"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td scope="row" class="cell">{{ $category->id }}</td>
                        <td class="cell">{{ $category->name }}</td>
                        <td class="cell">{{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y - H:i') }}</td>
                        <td class="cell">
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm app-btn-secondary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.categories.show', $category->id) }}" data-large="true" data-title="{{ __('Detalhes') }}"><i class="fas fa-eye text-info"></i> {{ __('Detalhes') }}</a>
                        </td>
                        <td class="cell">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm app-btn-secondary"><i class="fas fa-edit text-warning"></i> {{ __('Editar') }}</a>
                        </td>
                        <td class="cell">
                            <button type="button" data-url="{{ route('admin.categories.destroy', $category->id) }}"data-bs-toggle="modal" data-bs-target="#modal-delete" class="btn btn-sm app-btn-secondary delete"><i class="btn btn-danger btn-sm"></i> {{ __('Deletar') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection