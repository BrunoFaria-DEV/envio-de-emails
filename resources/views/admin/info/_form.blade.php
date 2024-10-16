@include('shared.errors')

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ Str::ucfirst(__('validation.attributes.facebook')) }}</label>
			<input type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook', $info->facebook ?? NULL) }}" autofocus>
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.twitter') }}</label>
			<input type="url" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter', $info->twitter ?? NULL) }}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.instagram') }}</label>
			<input type="url" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram', $info->instagram ?? NULL) }}">
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.youtube') }}</label>
			<input type="url" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ old('youtube', $info->youtube ?? NULL) }}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.whatsapp') }}</label>
			<input type="text" class="form-control phone_cellphone @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('whatsapp', $info->whatsapp ?? NULL) }}">
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.linkedin') }}</label>
			<input type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin', $info->linkedin ?? NULL) }}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.email') }} 1</label>
			<input type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ old('email1', $info->email1 ?? NULL) }}" required autocomplete="email">
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.email') }} 2</label>
			<input type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ old('email2', $info->email2 ?? NULL) }}" autocomplete="email">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.phone') }} 1</label>
			<input type="text" class="form-control phone_cellphone @error('phone1') is-invalid @enderror" name="phone1" value="{{ old('phone1', $info->phone1 ?? NULL) }}" required>
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
			<label class="form-label">{{ __('validation.attributes.phone') }} 2</label>
			<input type="text" class="form-control phone_cellphone @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2', $info->phone2 ?? NULL) }}">
		</div>
	</div>
</div>

<div class="pt-4 text-end">
	<button type="submit" class="btn app-btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
</div>