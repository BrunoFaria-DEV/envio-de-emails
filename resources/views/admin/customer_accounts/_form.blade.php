@include('shared.errors')

@if($customers->isEmpty())
	<div class="mb-3">
		<label class="form-label">Vincular Conta</label>
		<select id="related" name="related" class="selectize">
			<option disabled value="true" @if( old('customer_id', $customerAccount->id ?? NULL)) selected @endif>Vincular</option>
			<option value="false" @if( old('customer_id', $customerAccount->id ?? NULL)) selected @endif>Não Vincular</option>
		</select>
	</div>
	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
		<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customerAccount->name ?? NULL) }}" maxlength="255" autofocus>
	</div>

	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.email')) }}</label>
		<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customerAccount->email ?? NULL) }}" maxlength="255" autocomplete="email">
	</div>

	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.domain')) }}</label>
		<input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain', $customerAccount->domain ?? NULL) }}" maxlength="255" autofocus>
	</div>

	<div class="pt-4 text-end">
		<button type="submit" class="btn btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
	</div>	
@else
	<div class="mb-3">
		<label class="form-label">Vincular Conta</label>
		<select id="related" name="related" class="selectize">
			<option value="true" @if( !empty($customerAccount->customer_id) ) selected @endif>Vincular</option>
			<option value="false" @if( empty($customerAccount->customer_id) ) selected @endif>Não Vincular</option>
		</select>
	</div>

	<div class="mb-3" data-section="related">
		<label class="form-label">{{ Str::ucfirst(__('models.customer')) }}</label>
		<select name="customer_id" class="selectize">
			@foreach($customers as $customer)
				<option value="{{ $customer->id }}" @if( old('customer_id', $customer->id ?? NULL) == $customer->id) selected @endif>{{ $customer->type == 1 ? $customer->fantasy_name : $customer->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
		<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customerAccount->name ?? NULL) }}" maxlength="255" autofocus>
	</div>

	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.email')) }}</label>
		<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customerAccount->email ?? NULL) }}" maxlength="255" autocomplete="email">
	</div>

	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.domain')) }}</label>
		<input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain', $customerAccount->domain ?? NULL) }}" maxlength="255" autofocus>
	</div>

	<div class="pt-4 text-end">
		<button type="submit" class="btn btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
	</div>	
@endif

@vite(['resources/js/dashboard/pages/customer_accounts.js'])