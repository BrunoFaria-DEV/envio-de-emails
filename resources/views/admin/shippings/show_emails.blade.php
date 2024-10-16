<div class="container html-box">
    <div class="item mb-4">
        @if(isset($shippingError))
            @foreach($shippingError as $index => $shippingEmail)
                <div class="item-data text-md-start mb-2"><strong>{{$shippingEmail->email}}</strong></div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingStatus::getDescription($shippingEmail->status) }}</div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{$shippingEmail->error}}</div>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=error" class="btn btn-primary text-white px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar emails não enviados <i class="fas fa-table text-white"></i></a>
            <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Voltar') }}</a>
        </div>
        @elseif(isset($shippingSuccess))
            @foreach($shippingSuccess as $index => $shippingEmail)
                <div class="item-data text-md-start mb-2"><strong>{{$shippingEmail->email}}</strong></div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingStatus::getDescription($shippingEmail->status) }}</div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingEmailRead::getDescription($shippingEmail->read) }}</div>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=success" class="btn btn-primary text-white px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar emails enviados <i class="fas fa-table text-white"></i></a>
            <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Voltar') }}</a>
        </div>
        @elseif(isset($shippingAll))
            @foreach($shippingAll as $index => $shippingEmail)
                <div class="item-data text-md-start mb-2"><strong>{{$shippingEmail->email}}</strong></div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingStatus::getDescription($shippingEmail->status) }}</div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingEmailRead::getDescription($shippingEmail->read) }}</div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{$shippingEmail->error}}</div>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=all" class="btn btn-primary text-white px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar todos os emails <i class="fas fa-table text-white"></i></a>
            <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Voltar') }}</a>
        </div>
        @elseif(isset($shippingRead))
            @foreach($shippingRead as $index => $shippingEmail)
                <div class="item-data text-md-start mb-2"><strong>{{$shippingEmail->email}}</strong></div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingStatus::getDescription($shippingEmail->status) }}</div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">{{ \App\Enums\ShippingEmailRead::getDescription($shippingEmail->read) }}</div>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.shippings.csv') }}?shipping={{ $shipping->id }}&shipping_email=read" class="btn btn-primary text-white px-3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="CSV">Exportar cliques no link <i class="fas fa-table text-white"></i></a>
            <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Voltar') }}</a>
        </div>
        @elseif(isset($shippingImage))
            @foreach($shipping->shippingImages()->get() as $key => $shippingImage)
                <div class="item-data text-md-start mb-2">
                    <img src="{{ url("storage/{$shippingImage->image}") }}" height="50px" target="_blank"></img>
                </div>
                <div class="item-data text-md-start bg-info bg-opacity-10 rounded">
                    <a href="{{ url("storage/{$shippingImage->image}") }}" style="overflow-wrap: break-word;" target="_blank">
                        <span style="font-size: 100%;"> {{ url("storage/{$shippingImage->image}") }} </span>
                    </a>
                </div>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.shippings.show', $shipping->id) }}" class="btn btn-primary show-item" data-bs-toggle="modal" data-bs-target="#modal-show" data-url="{{ route('admin.shippings.show', $shipping->id) }}" data-large="true" data-title="{{ __('Detalhes') }}">{{ __('Voltar') }}</a>
        </div>
        @endif
