@include('shared.errors')


<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.type')) }}</label>
	<select name="type" id="type" class="selectize">
		@foreach(range(0, 1) as $option)
			<option value="{{ $option }}" @if(old('type', $customer->type ?? NULL) == $option) selected @endif>{{ \App\Enums\CustomerType::getDescription($option) }}</option>
		@endforeach
	</select>
</div>

<div class="mb-3" data-section="pf">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
	<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customer->name ?? NULL) }}" maxlength="255" autofocus>
</div>

<div class="mb-3" data-section="pj">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.fantasy_name')) }}</label>
	<input type="text" class="form-control @error('fantasy_name') is-invalid @enderror" name="fantasy_name" 			
	@if(isset($customer))
		@if($customer->type == 1) 
			value="{{ old('fantasy_name', $customer->fantasy_name ?? NULL) }}"
		@else
			value="{{ old('fantasy_name') }}"
		@endif
	@else
		value="{{ old('fantasy_name') }}"
	@endif 
	maxlength="255" autofocus>
</div>

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.email')) }}</label>
	<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customer->email ?? NULL) }}" maxlength="255" autocomplete="email">
</div>


<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.phone')) }}</label>
	<input type="text" class="form-control phone_cellphone @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $customer->phone ?? NULL) }}">
</div>

<div class="mb-3" data-section="pf">
	<label class="form-label">{{ Str::upper(__('validation.attributes.cpf')) }}</label>
	<input type="text" class="form-control cpf @error('cpf') is-invalid @enderror" name="cpf" 
	@if(isset($customer))
		@if($customer->type == 0) 
			value="{{ old('cpf', $customer->cpf ?? NULL) }}"
		@else
			value="{{ old('cpf') }}"
		@endif
	@else
		value="{{ old('cpf') }}"
	@endif >
</div>

<div class="row" data-section="pj">
	<div class="col-md-3">
		<div class="mb-3">
			<label class="form-label">{{ Str::upper(__('validation.attributes.cnpj')) }}</label>
			<input type="text" class="form-control cnpj @error('cnpj') is-invalid @enderror" name="cnpj" 
				@if(isset($customer))
					@if($customer->type == 1) 
						value="{{ old('cnpj', $customer->cnpj ?? NULL) }}"
					@else
						value="{{ old('cnpj') }}"
					@endif
				@else
					value="{{ old('cnpj') }}"
				@endif
			>
		</div>
	</div>
</div>

<div class="pt-4 text-end">
	<button type="submit" class="btn btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
</div>

@vite(['resources/js/dashboard/pages/customers.js'])