<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.total_emails')) }}</strong>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ '(' . count($shipping->shippingEmails).') criados' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-primary">
                      <li>
                        <a href="{{ route('admin.shippings.show', $shipping->id) }}?shipping_all=1" class="shipping-error dropdown-item" data-bs-toggle="modal" data-bs-target="#shipping-error" data-url="{{ route('admin.shippings.show', $shipping->id) }}?shipping_all=1" data-large="true" data-title="{{ __('Todos os Emails') }}">{{ __('Detalhes') }}</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=all" class="px-3 me-3 dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar <i class="fas fa-table"></i></a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.success')) }}</strong></div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ '(' . count($shipping->shippingEmails->where('status', 'S')).') enviados' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-primary">
                      <li>
                        <a href="{{ route('admin.shippings.show', $shipping->id) }}?shipping_success=1" class="shipping-error dropdown-item" data-bs-toggle="modal" data-bs-target="#shipping-error" data-url="{{ route('admin.shippings.show', $shipping->id) }}?shipping_success=1" data-large="true" data-title="{{ __('Emails Enviados') }}">{{ __('Detalhes') }}</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=success" class="px-3 me-3 dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar <i class="fas fa-table"></i></a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label"><strong>Não enviados </strong></div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ '(' . count($shipping->shippingEmails->where('status', 'F')).') Não enviados' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-primary">
                      <li>
                        <a href="{{ route('admin.shippings.show', $shipping->id) }}?shipping_error=1" class="shipping-error dropdown-item" data-bs-toggle="modal" data-bs-target="#shipping-error" data-url="{{ route('admin.shippings.show', $shipping->id) }}?shipping_error=1" data-large="true" data-title="{{ __('Emails Não Enviados') }}">{{ __('Detalhes') }}</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=error" class="px-3 me-3 dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar <i class="fas fa-table"></i></a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label"><strong>Cliques no link</strong></div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ '(' .  count($shipping->shippingEmails->where('read', 'R')).') cliques' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-primary">
                      <li>
                        <a href="{{ route('admin.shippings.show', $shipping->id) }}?shipping_read=1" class="shipping-error dropdown-item" data-bs-toggle="modal" data-bs-target="#shipping-error" data-url="{{ route('admin.shippings.show', $shipping->id) }}?shipping_read=1" data-large="true" data-title="{{ __('Cliques no Link') }}">{{ __('Detalhes') }}</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=read" class="px-3 me-3 dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar <i class="fas fa-table"></i></a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label"><strong>{{ Str::ucfirst(__('validation.attributes.title')) }}</strong></div>
                <div class="item-data">{{ $shipping->title ?? 'não cadastrado' }}</div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="item-label text-md-start"><strong>{{ Str::ucfirst(__('validation.attributes.status')) }}</strong></div>
                <div class="item-data text-md-start">{{ \App\Enums\ShippingStatus::getDescription($shipping->status) }}</div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="item mb-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ '(' .  count($shipping->shippingImages) .') Imagens' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-primary">
                      <li>
                        <a href="{{ route('admin.shippings.show', $shipping->id) }}?shipping_image=1" class="shipping-error dropdown-item" data-bs-toggle="modal" data-bs-target="#shipping-error" data-url="{{ route('admin.shippings.show', $shipping->id) }}?shipping_image=1" data-large="true" data-title="{{ __('Imagens do Disparo') }}">{{ __('Detalhes') }}</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="item mb-4">
                <div class="item-label text-md-start"><strong>HTML</strong></div>
                <div class="html-box">
                    {!! isset($shipping->html) ? $shipping->html : null !!}
                </div>
            </div>
        </div>
    </div>
</div>
