	<div class="row">
		@if(isset($customerAccount->customer))
			@if ($customerAccount->customer->type == 1)
				<div class="col">
					<div class="item mb-4">
						<div class="item-label"><strong>{{ Str::ucfirst(__('models.customer')) }}</strong></div>
						<div class="item-data">{{ $customerAccount->customer->fantasy_name ?? 'não cadastrado' }}</div>
					</div>
				</div>
			@else
				<div class="col">
					<div class="item mb-4">
						<div class="item-label"><strong>{{ Str::ucfirst(__('models.customer')) }}</strong></div>
						<div class="item-data">{{ $customerAccount->customer->name ?? 'não cadastrado' }}</div>
					</div>
				</div>
			@endif
		@else
			<div class="col">
				<div class="item mb-4">
					<div class="item-label"><strong>{{ Str::ucfirst(__('models.customer')) }}</strong></div>
					<div class="item-data">{{ 'não cadastrado' }}</div>
				</div>
			</div>
		@endif
		<div class="col">
			<div class="item mb-4">
				<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.name')) }}</strong></div>
				<div class="item-data">{{ $customerAccount->name ?? 'não cadastrado' }}</div>
			</div>
		</div>
		<div class="col">
			<div class="item mb-4">
				<div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.email')) }}</strong></div>
				<div class="item-data text-md-start">{{ $customerAccount->email ?? 'não cadastrado'}}</div>
			</div>
		</div>
		<div class="col">
			<div class="item mb-4">
				<div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.domain')) }}</strong></div>
				<div class="item-data text-md-start">{{ $customerAccount->domain ?? 'não cadastrado'}}</div>
			</div>
		</div>
	</div>
