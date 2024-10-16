<div class="card mb-3" style="border: 1px dashed #ddd;">
	<div class="card-body">
		<h5 class="card-title">Antes</h5>
		@foreach($audit->old_values as $attribute => $value)
			@if(!$loop->last)
				<div class="item mb-4">
			@else
				
			@endif
				<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.' . $attribute)) }}</strong></div>
				<div class="item-data">{{ $value }}</div>
			</div>
		@endforeach
	</div>
</div>

<div class="card" style="border: 1px dashed #ddd;">
	<div class="card-body">
		<h5 class="card-title">Depois</h5>
		@foreach($audit->new_values as $attribute => $value)
			@if(!$loop->last)
				<div class="item mb-4">
			@else
				<div class="item">
			@endif
				<div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.' . $attribute)) }}</strong></div>
				<div class="item-data">{{ $value }}</div>
			</div>
		@endforeach
	</div>
</div>