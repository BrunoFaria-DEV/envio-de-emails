@extends('layouts.app')

@section('content')
<div class="py-5 page login d-flex align-items-center">
  <div class="container">
        
    <form method="POST" action="{{ route('login') }}" class="row d-flex m-1 justify-content-center">
      @csrf

      <div class="col-lg-6 p-4 p-lg-5 rounded-5 bg-white shadow">
        <legend class="mb-5 text-center">{{ $title }}</legend>

        <input type="hidden" name="referer" value="{{ url()->previous() }}">

        <div class="mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Endereço de Email') }}" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Senha') }}" required autocomplete="current-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Lembrar') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-6 text-end">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                {{ __('Esqueceu sua senha?') }}
              </a>
            @endif
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="btn btn-primary w-100">
            {{ __('Log in') }}
          </button>
          <p class="line-title my-4">
            <span class="bg-white">Ou</span>
          </p>
          {{-- <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Criar uma conta</a> --}}
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
