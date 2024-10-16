<div class="item mb-4">
	<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.name')) }}</strong></div>
	<div class="item-data">{{ $user->name }}</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="item mb-4">
			<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.email')) }}</strong></div>
			<div class="item-data">{{ $user->email }}</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="item mb-4">
			<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.cellphone')) }}</strong></div>
			<div class="item-data">{{ $user->cellphone }}</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="item mb-4">
			<div class="item-label"><strong>{{ Str::upper(__('validation.attributes.cpf')) }}</strong></div>
			<div class="item-data">{{ !$user->cpf ? NULL : mask('###.###.###-##', $user->cpf) }}</div>
		</div>
	</div>
</div>