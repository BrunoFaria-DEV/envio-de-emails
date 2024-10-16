<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>{{ config('app.name', 'Rondocredi') }} - Painel Administrador | {{ @$title }}</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<meta name="description" content="{{ config('app.name', 'Rondocredi') }} - Painel Administrador">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	{{-- <link rel="shortcut icon" href="{{ Vite::asset('img/favicon.ico') }}"> --}}

	<!-- Scripts -->
	@vite(['resources/sass/dashboard/styles.scss'])
</head>
<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper align-items-center">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-5">
						<a class="app-logo" href="{{ url('/') }}">
							<img class="logo-icon" src="{{ Vite::asset('resources/img/brand.png') }}" alt="logo">
						</a>
					</div>
					<div class="auth-form-container text-start">
						<form action="{{ route('login') }}" method="POST" role="form" class="auth-form login-form">
							@csrf
							@include('shared.errors')
							<div class="email mb-3">
								<input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" required="required" autocomplete="email" autofocus>
							</div>
							<div class="password mb-3">
								<input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
											<label class="form-check-label" for="remember">
												Lembrar
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-secondary w-100 theme-btn mx-auto">Entrar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
	    <div class="auth-background-holder">
	    </div>
	    <div class="auth-background-mask"></div>
	    <div class="auth-background-overlay p-3 p-lg-5"></div>
    </div>
	</div>
</body>
</html>