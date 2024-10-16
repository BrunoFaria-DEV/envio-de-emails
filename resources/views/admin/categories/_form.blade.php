@include('shared.errors')

<div class="mb-3">
	<label class="form-label">{{ Str::ucfirst(__('validation.attributes.category')) }}</label>
	<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name ?? NULL) }}">
</div>

<div class="pt-4 text-end">
	<button type="submit" class="btn app-btn-primary px-4"><i class="fas fa-check me-1"></i>Salvar</button>
</div>