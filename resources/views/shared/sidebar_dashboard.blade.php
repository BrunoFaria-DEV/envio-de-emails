<div id="sidepanel-drop" class="sidepanel-drop"></div>
<div class="sidepanel-inner d-flex flex-column">
  <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
  <div class="app-branding">
    <a class="app-logo" href="{{ route('admin.home') }}">
      <img class="logo-icon" src="{{ asset('logo.png') }}" alt="logo">
    </a>
  </div>

  <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
      <li class="nav-item">
        <a class="nav-link {{ str_contains(Route::current()->getName(), 'home') ? 'active' : NULL }}" href="{{ route('admin.home') }}">
          <i class="fa-solid fa-house me-2"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>

      @can('editar informacoes basicas')
        <li class="nav-item">
          <a class="nav-link {{ str_contains(Route::current()->getName(), 'info') ? 'active' : NULL }}" href="{{ route('admin.info.edit', 1) }}">
            <i class="fa-solid fa-circle-info me-2"></i>
            <span class="nav-link-text">{{ __('models.info') }}</span>
          </a>
        </li>
      @endcan

      <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Sistema
    </div>

      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              <i class="fa-regular fa-user me-2"></i>
              <span class="nav-link-text">Clientes</span>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <a class="nav-link {{ str_contains(Route::current()->getName(), 'customers') ? 'active' : NULL }}" href="{{ route('admin.customers.index') }}">
                <i class="fa-solid fa-person me-2"></i>
                <span class="nav-link-text">{{ Str::plural(__('models.customer')) }}</span>
              </a>
              <a class="nav-link {{ str_contains(Route::current()->getName(), 'customer_accounts') ? 'active' : NULL }}" href="{{ route('admin.customer_accounts.index') }}">
                <i class="fa-regular fa-rectangle-list me-2"></i>
                <span class="nav-link-text">{{ trans_choice('models.customer_account', 2) }}</span>
              </a>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              <i class="fa-regular fa-message me-2"></i>
              <span class="nav-link-text">Disparos</span>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <a class="nav-link {{ str_contains(Route::current()->getName(), 'shippings') ? 'active' : NULL }}" href="{{ route('admin.shippings.index') }}">
                <i class="fa-solid fa-paper-plane me-2"></i>
                <span class="nav-link-text">{{ Str::plural(__('models.shipping')) }}</span>
              </a>
            </div>
          </div>
        </div>
        {{-- <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">

            </div>
          </div>
        </div> --}}
      </div>

  </nav>

  @role(['super-admin|admin|suporte|desenvolvimento'])
    <div class="app-sidepanel-footer">
      <nav class="app-nav app-nav-footer">
        <ul class="app-menu footer-menu list-unstyled">
          <li class="nav-item">
            <a class="nav-link {{ str_contains(Route::current()->getName(), 'audit') ? 'active' : NULL }}" href="{{ route('admin.audit.index') }}">
              <i class="fa-solid fa-magnifying-glass me-2"></i>
              <span class="nav-link-text">{{ __('models.audit') }}</span>
            </a>
          </li>
        @role('super-admin')
          <li class="nav-item">
            <a class="nav-link {{ str_contains(Route::current()->getName(), 'roles') ? 'active' : NULL }}" href="{{ route('admin.roles.index') }}">
              <i class="fa-solid fa-list-check me-2"></i>
              <span class="nav-link-text">{{ trans_choice('models.role', 2) }}</span>
            </a>
          </li>
        @endrole
          <li class="nav-item">
            <a class="nav-link {{ str_contains(Route::current()->getName(), 'users') ? 'active' : NULL }}" href="{{ route('admin.users.index') }}">
              <i class="fa-solid fa-user-group me-2"></i>
              <span class="nav-link-text">{{ Str::plural(__('models.user')) }}</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  @endrole
</div>
