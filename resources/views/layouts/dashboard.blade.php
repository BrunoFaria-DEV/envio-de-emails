<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>{{ config('app.name', 'Venda Facil') }} - Painel Administrador | {{ @$title }}</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="description" content="{{ config('app.name', 'Venda Facil') }} - Painel Administrador">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	<link rel="shortcut icon" href="{{ Vite::asset('resources/img/favicon.ico') }}">

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<!-- Scripts -->
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!};
	</script>
	@vite(['resources/sass/dashboard/styles.scss', 'resources/js/dashboard/scripts.js'])
</head>
<body class="app">
	<header class="app-header fixed-top">
		<div class="app-header-inner">
			<div class="container-fluid py-2">
				<div class="app-header-content">
					<div class="row justify-content-between align-items-center">
						<div class="col-auto">
							<a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
							</a>
						</div>
						@if(Route::has('admin.'.str_replace('-', '_', request()->segment(2)).'.index') && !in_array(request()->segment(2), ['info']))
							<div class="search-mobile-trigger d-sm-none col">
								<i class="search-mobile-trigger-icon fas fa-search"></i>
							</div>
							<div class="app-search-box col">
								<form action="{{ route('admin.'.str_replace('-', '_', request()->segment(2)).'.index') }}" method="GET" class="app-search-form">
									<input type="text" placeholder="Pesquisar..." name="keyword" value="{{ request()->get('keyword') }}" class="form-control search-input">
									<button type="submit" class="btn search-btn btn-primary" value="Pesquisar"><i class="fas fa-search"></i></button>
								</form>
							</div>
						@endif

						<div class="app-utilities d-flex align-items-center col-auto">
							@can('visualizar message')
								<div class="app-utility-item app-messages-dropdown dropdown">
									<a class="dropdown-toggle d-inline-block no-toggle-arrow" id="messages-dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-expanded="false" title="{{ trans_choice('models.message', 2) }}">
										<span class="material-symbols-outlined icon">message</span>
										<span class="icon-badge">{{ $messages->count() }}</span>
									</a>

									<div class="dropdown-menu p-0" aria-labelledby="messages-dropdown-toggle">
										<div class="dropdown-menu-header p-3">
											<h5 class="dropdown-menu-title mb-0">
												{{ trans_choice('models.message', 2) }}
												<a href="{{ route('admin.messages.index') }}" class="d-inline-block float-end" style="font-size: .75rem; line-height: 1rem;">Ver Todas</a>
											</h5>
										</div>
										<div class="dropdown-menu-content">
											@foreach($messages as $key => $message)
												<div class="item p-3 show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.messages.show', $message->slug) }}" data-large="true" data-title="Visualizar">
													<div class="row gx-2 justify-content-between align-items-center">
														<div class="col">
															<div class="info" style="padding-right: 140px;">
																<div class="desc" style="text-align: justify;">{{ Str::words(strip_tags($message->body), 6, '...') }}</div>
																<div class="meta">{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y - H:i') }}</div>
															</div>
														</div>
													</div>
													<a class="link-mask" href="{{ route('admin.messages.show', $message->slug) }}"></a>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							@endcan

							<div id="time" class="me-4 fw-medium"></div>

							<div class="app-utility-item app-user-dropdown dropdown">
								<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-expanded="false">
									<img src="{{ !auth()->user()->avatar ? 'https://ui-avatars.com/api/?name='.auth()->user()->name.'&background=555&color=fff' : Storage::url(auth()->user()->avatar) }}" alt="user profile" class="rounded-circle" onerror="this.src='https://ui-avatars.com/api/?name='{{ auth()->user()->name }}'&background=555&color=fff';">
								</a>
								<ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
									<li><a class="dropdown-item" href="{{ route('admin.users.edit', auth()->user()->id) }}">Editar Conta</a></li>
									<li><hr class="dropdown-divider"></li>
									<li>
										<a class="dropdown-item" href="javascript:void(0)" 
										onclick="event.preventDefault(); 
														document.getElementById('logout-form').submit();">Sair</a>
										<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="app-sidepanel" class="app-sidepanel">
			@include('shared.sidebar_dashboard')
		</div>
	</header>

	<div class="app-wrapper">
		<div class="app-content pt-3 p-md-3 p-lg-4">
			<div class="container-xl">
				@yield('content')
			</div>
		</div>
	</div>

	@include('shared.modal_dashboard')

	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			$(this).on('click', '.app-messages-dropdown .show-item', function(e) {
				let url = $(this).data('url'),
						badge = $(this).parents('.app-messages-dropdown').find('.icon-badge'),
						count = badge.text();

				function updateMessageCount() {
					return function(event, xhr, settings) {
						if (settings.url == url) {
							if(parseInt(count) > 0)
								badge.text(parseInt(count) - 1);
						}
					}
				}

				$(document).ajaxSuccess(updateMessageCount());
			});
		}, false);

        function updateClock() {
            const options = {
                timeZone: '{!! config('app.timezone') !!}',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            };
            const now = new Date();
            const formatter = new Intl.DateTimeFormat('pt-BR', options);
            document.getElementById('time').innerHTML = formatter.format(now);
        }

        setInterval(updateClock, 1000);
        updateClock();
	</script>

	@stack('scripts')
</body>
</html>
