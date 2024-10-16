@include('shared.errors')

@role('super-admin|admin|suporte')
	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
		<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name ?? NULL) }}" autofocus>
	</div>
	<div class="mb-3">
		<label class="form-label">{{ trans_choice('models.role', 1) }}</label>
		<select name="role" id="role" class="selectize @error('role') is-invalid @enderror">
			@foreach($roles as $option)
				<option value="{{ $option->name }}" {{ in_array($option->id, (array) old('role', !isset($user->roles) ? [] : $user->roles->pluck('id')->toArray())) ? 'selected' : NULL }} required>{{ $option->name }}</option>
			@endforeach
		</select>
	</div>
@else
	@foreach(auth()->user()->getRoleNames() as $key => $role)
		<input type="hidden" name="role" value="{{ $role }}">
	@endforeach
	<div class="mb-3">
		<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
		<input type="text" class="selectize @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name ?? NULL) }}">
	</div>
@endrole

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.email')) }}</label>
	<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email ?? NULL) }}" autocomplete="email">
</div>

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.cellphone')) }}</label>
	<input type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" value="{{ old('cellphone', $user->cellphone ?? NULL) }}">
</div>


<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.password')) }}</label>
	<input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
</div>
<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.password_confirmation')) }}</label>
	<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
</div>


<label class="form-label">{{ Str::ucfirst(__('validation.attributes.avatar')) }} <small>Tamanho Máximo (300 &bull; 300 px)</small></label>
<div class="mb-3">
	<input type="hidden" name="current_file" value="{{ old('current_file', $user->avatar ?? NULL) }}">
	<input type="file" name="avatar" class="form-control" accept="image/*">
</div>

<div class="pt-4 text-end">
	<button type="submit" class="btn btn-primary px-4"><i class="fas fa-check me-1"></i> {{ Str::ucfirst(__('general.submit')) }}</button>
</div>

@vite(['resources/js/dashboard/pages/users.js'])