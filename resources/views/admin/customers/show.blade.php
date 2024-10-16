@if ($customer->type == 1)
    <div class="item mb-4">
        <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.fantasy_name')) }}</strong></div>
        <div class="item-data">{{ $customer->fantasy_name ?? 'não cadastrado' }}</div>
    </div>

    <div class="item mb-4">
        <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.cnpj')) }}</strong></div>
        <div class="item-data">{{ cnpj($customer->cnpj) ?? 'não cadastrado' }}</div>
    </div>
@else
    <div class="item mb-4">
        <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.name')) }}</strong></div>
        <div class="item-data">{{ $customer->name ?? 'não cadastrado' }}</div>
    </div>

    <div class="item mb-4">
        <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.cpf')) }}</strong></div>
        <div class="item-data">{{ cpf($customer->cpf) ?? 'não cadastrado' }}</div>
    </div>
@endif


<div class="item mb-4">
    <div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.email')) }}</strong></div>
    <div class="item-data text-md-start">{{ $customer->email ?? 'não cadastrado' }}</div>
</div>

<div class="item mb-4">
    <div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.phone')) }}</strong></div>
    {{-- <div class="item-data text-md-start">{{ telphone($customer->phone) ?? 'não cadastrado'}}</div> --}}
    <div class="item-data text-md-start">{{ $customer->phone ?? 'não cadastrado' }}</div>
</div>
