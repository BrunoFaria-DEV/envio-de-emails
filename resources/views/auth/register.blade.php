@extends('layouts.app')

@section('content')
<div class="py-5 page register d-flex align-items-center">
  <div class="container">

    <form method="POST" action="{{ route('register') }}" class="row d-flex m-1 justify-content-center" onsubmit="register(this, event)">
      @csrf
      @include('shared.errors')
      @include('shared.flash_messages')

      <div class="col-lg-6 p-4 p-lg-5 rounded-5 bg-white shadow">
        <legend class="mt-0 mb-5 text-center">{{ $title }}</legend>

        <input type="hidden" name="referer" value="{{ url()->previous() }}">

        <div class="mb-3">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? NULL }}" placeholder="* {{ Str::ucfirst(__('validation.attributes.name')) }}" autofocus>

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? NULL }}" placeholder="* {{ Str::ucfirst(__('validation.attributes.email')) }}">

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="cellphone" type="cellphone" class="form-control cellphone @error('cellphone') is-invalid @enderror" name="cellphone" value="{{ old('cellphone') ?? NULL }}" placeholder="* {{ Str::ucfirst(__('validation.attributes.cellphone')) }}">

          @error('cellphone')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="fantasy_name" type="fantasy_name" class="form-control @error('fantasy_name') is-invalid @enderror" name="fantasy_name" value="{{ old('fantasy_name') ?? NULL }}" placeholder="* {{ Str::ucfirst(__('validation.attributes.fantasy_name')) }}">

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">{{ Str::ucfirst(__('validation.attributes.type')) }}</label>
          <select name="type" id="type" class="selectize">
            @foreach(range(0, 1) as $option)
              <option value="{{ $option }}" @if(old('type', $user->type ?? NULL) == $option) selected @endif @if($option == 1) selected="selected" @endif >{{ \App\Enums\UserType::getDescription($option) }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3" data-section="pf">
          <input id="cpf" type="cpf" class="form-control cpf @error('cnpj') is-invalid @enderror" name="cpf" value="{{ old('cpf') ?? NULL }}" placeholder="* {{ Str::upper(__('validation.attributes.cpf')) }}">

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3" data-section="pj">
          <input id="cnpj" type="cnpj" class="form-control cnpj @error('cnpj') is-invalid @enderror" name="cnpj" value="{{ old('cnpj') ?? NULL }}" placeholder="* {{ Str::upper(__('validation.attributes.cnpj')) }}">

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{!! $message !!}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="* {{ Str::ucfirst(__('validation.attributes.password')) }}" autocomplete="new-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="* {{ Str::ucfirst(__('validation.attributes.password_confirmation')) }}" autocomplete="new-password">

          @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY', 'default_value') }}" data-callback="enableSubmit" data-expired-callback="disableSubmit" style="transform: scale(0.9); transform-origin: 0 0;"></div>

        <div class="pt-4">
          <button disabled type="submit" class="btn btn-primary w-100">
            Criar uma conta
          </button>
          <p class="line-title my-4">
            <span class="bg-white">Ou</span>
          </p>
          <a href="/" class="btn btn-outline-primary w-100">{{ __('Log in') }}</a>
        </div>
      </div>
    </form>
  </div>
</div>

@vite(['resources/js/pages/register.js'])

@endsection
