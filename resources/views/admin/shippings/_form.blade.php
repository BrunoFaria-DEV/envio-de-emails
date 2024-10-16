@include('shared.errors')
@include('shared.flash_messages')

@if($customerAccounts->isEmpty())
	<div class="mb-3">
		<label class="form-label">Criar Nova Conta</label>
		<select id="newaccount" name="newaccount" class="selectize">
			<option disabled value="false">Usar Existente</option>
			<option value="true">Criar Conta</option>
		</select>
	</div>
@else
	<div class="mb-3">
		<label class="form-label">Criar Nova Conta</label>
		<select id="newaccount" name="newaccount" class="selectize">
			<option value="false" @if( old('newaccount') == 'false') selected @endif selected>Usar Existente</option>
			<option value="true" @if( old('newaccount') == 'true') selected @endif>Criar Conta</option>
		</select>
	</div>
@endif

<div class="row" data-section="newaccount">
	<div class="mb-3">
		<label class="form-label">Nova Conta</label>
		<div class="row py-3 border border-3 border-info border-opacity-25 bg-info bg-opacity-10 rounded">

			@if($customers->isEmpty())
				<div class="row justify-content-center">
					<div class="col-4">
						<div class="mt-3 mb-3 text-center">
							<span><strong>Deseja adicionar um novo <br> cliente antes de criar uma conta?</strong><br></span>
							<a href="{{ route('admin.customers.create') }}" class="btn btn-primary px-3 mt-2">Cadastrar Cliente</a>
						</div>
					</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Vincular Conta</label>
					<select id="related" name="related" class="selectize">
						<option disabled value="true">Vincular</option>
						<option value="false" selected>Não Vincular</option>
					</select>
				</div>
			@else
				<div class="mb-3">
					<label class="form-label">Vincular Conta</label>
					<select id="related" name="related" class="selectize">
						<option value="true" @if( old('related') == 'true') selected @endif>Vincular</option>
						<option value="false" @if( old('related') == 'false') selected @endif>Não Vincular</option>
					</select>
				</div>
				<div class="col-10 mb-3" data-section="related">
					<label class="form-label">{{ Str::ucfirst(__('models.customer')) }}</label>
					<select id="customer_id" name="customer_id" class="selectize">
						@foreach($customers as $customer)
							<option value="{{ $customer->id }}" @if( old('customer_id') == $customer->id) selected @endif>{{ $customer->type == 1 ? $customer->fantasy_name : $customer->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 mb-3" data-section="related">
					<label class="form-label">Novo Cliente</label>
					<a href="{{ route('admin.customers.create') }}" class="float-left btn btn-primary px-3">Cadastrar Cliente</a>
				</div>
			@endif

			<div class="mb-3">
				<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customerAccount->name ?? NULL) }}" maxlength="255" autofocus required>
			</div>

			<div class="mb-3">
				<label class="form-label">{{ Str::ucfirst(__('validation.attributes.email')) }}</label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customerAccount->email ?? NULL) }}" maxlength="255" autocomplete="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label">{{ Str::ucfirst(__('validation.attributes.domain')) }}</label>
				<input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain', $customerAccount->domain ?? NULL) }}" maxlength="255" autofocus required>
			</div>
		</div>
	</div>
</div>

<div class="mb-3" data-section="oldaccount">
	<label class="form-label">{{ trans_choice('models.customer_account', 1) }}</label>
	<select id="customer_account_id" name="customer_account_id" class="selectize">
		@foreach($customerAccounts as $customerAccount)
			<option value="{{ $customerAccount->id }}" @if( old('customer_account_id', $shipping->customerAccount->id ?? NULL) == $customerAccount->id) selected @endif>{{ $customerAccount->name }}</option>
		@endforeach
	</select>
</div>

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.title')) }}</label>
	<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $shipping->title ?? NULL) }}" maxlength="255" autofocus required>
</div>

<div class="mb-3">
	<label class="form-label">HTML</label>
	<textarea class="form-control @error('html') is-invalid @enderror" name="html" placeholder="Insira o texto do email aqui" id="text_area_html" rows="8" required>{{ isset($shipping->html) ? nl2br($shipping->html) : NULL }}</textarea>
</div>

<div class="mb-3">
	<label class="form-label">Imagens <br><small class="fw-medium text-primary">*Tamanho Máximo (2Mb)</small> <br><small class="fw-medium text-primary">**Formatos aceitos: jpeg, png, bmp, webp e gif.</small></label>
	<input type="file" name="images[]" class="form-control @error('file') is-invalid @enderror" accept="image/*" autofocus multiple>
</div>

<div class="mb-3">
	<label class="form-label">Lista de Emails</label>
	<input type="file" name="file" @if(Route::currentRouteName() == 'admin.shippings.create') id="file" @endif class="form-control @error('file') is-invalid @enderror" accept=".csv" autofocus @if(Route::current()->getName() == 'admin.shippings.create') required @endif>
</div>

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.shipping_code')) }} <br><small class="fw-medium text-primary">*Apenas letras (maiúsculas e minúsculas), números (0-9), hífens (-) e sublinhados (_) são permitidos.</small></label>
	<input type="text" class="form-control @error('shipping_code') is-invalid @enderror" name="shipping_code" value="{{ old('shipping_code', $shipping->shipping_code ?? NULL) }}" maxlength="30" oninput="this.value = this.value.replace(/[^A-Za-z0-9_-]/g, '')" autofocus required>
</div>

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.type').' de '.__('models.shipping')) }}</label>
	<select id="shipping_type" name="shipping_type" class="selectize">
		<?PHP $options = ['I', 'S'] ?>
		@foreach($options as $option)
			<option value="{{ $option }}" @if(old('type', $shipping->shipping_type ?? NULL) == $option) selected @endif>{{ \App\Enums\ShippingType::getDescription($option) }}</option>
		@endforeach
	</select>
</div>

<div class="mb-3" data-section="shipping_date">
	<label class="form-label">Data Inicial</label>
	<input type="datetime-local" name="shipping_date" class="form-control"
		value="{{ old('shipping_date', $shipping->shipping_date ?? NULL) }}" required/>
</div>

<div class="pt-4 text-end">
	<button type="submit" class="btn btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
</div>

@vite(['resources/js/dashboard/pages/shippings.js'])
