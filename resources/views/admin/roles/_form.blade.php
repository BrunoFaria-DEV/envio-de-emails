@include('shared.errors')

<div class="mb-4">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.name')) }}</label>
	<input type="text" name="name" value="{{ old('name', $role->name ?? NULL) }}" class="form-control" {{ in_array(@$role->name, ['super-admin', 'admin', 'cliente']) ? 'readonly' : NULL }} required>
</div>

@foreach($permissions as $permission)
	<div class="mb-3">
		<label class="form-switch ps-0">
			<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $role_permissions)) ? 'checked' : NULL }}>
			<i></i>
			{{ ucfirst($permission->name) }}
		</label>
	</div>
@endforeach

<div class="pt-4 text-end">
	<button type="submit" class="btn app-btn-primary px-4">{{ Str::ucfirst(__('general.submit')) }}</button>
</div>