@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">Order Details</h3>

            @if($shopping)
                <div class="card">
                    <div class="card-header text-center">
                        Order ID: #{{ $shopping -> id }}
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="text-muted">{{ __('frontend/shop.order_date') }}: </span> {{ $shopping -> created_at->format('M j, Y') }}
                        </div>
                        <hr>
                        <div class="delivery-steps">
                            <div class="delivery-step-bar"></div>
                            <div class="delivery-step-item active">
                                <h6>Bestellung bestatigt</h6>
                                <div class="delivery-step-dot"></div>
                                <span>Wed, 1th Jan<span>
                            </div>
                            <div class="delivery-step-item">
                                <h6>Versandt</h6>
                                <div class="delivery-step-dot"></div>
                                <span>Wed, 1th Jan<span>
                            </div>
                            <div class="delivery-step-item">
                                <h6>In Zustellung</h6>
                                <div class="delivery-step-dot"></div>
                                <span>Wed, 1th Jan<span>
                            </div>
                            <div class="delivery-step-item">
                                <h6>Zugestellt</h6>
                                <div class="delivery-step-dot"></div>
                                <span>Expected by, Mon 16th<span>
                            </div>
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table table-transactions table-borderless">
                                <tbody>
                                    @foreach($shopping->getOrders() as $order)
                                    <tr class="">
                                        
                                        <td>
                                            <div class="d-flex">
                                                @if($product = $order->getProduct())
                                                    @if($main_img = $product->getMainImage())
                                                        <img src="{{ '/files/' . $main_img->img_path }}" class="product-img-sm">
                                                    @endif
                                                @endif
                                                <div class="product-detail">
                                                    <div>{{ $order->name }}</div>
                                                    <div>
                                                        <span class="text-muted">
                                                            @if($order->variant_id)
                                                                {{ $order->getVariant()->title }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end"> 
                                            <div>
                                                {{ $order->getFormattedPrice() }} 
                                            </div>
                                            <div>
                                                Qty: 
                                                <span>
                                                    @if($order->variant_id)
                                                        1
                                                    @else
                                                        @if($order->getAmount() > 1)
                                                            {{ $order->getAmount() }}
                                                        @elseif($order->asWeight())
                                                            {{ $order->getWeight() . $order->getWeightChar() }}
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <strong>{{ __('frontend/shop.payment') }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <strong>{{ __('frontend/shop.delivery') }}</strong>
                                </div>
                                <div>
                                    <small>{{ __('frontend/shop.delivery_method.address') }}</small><br>
                                    @if(strlen($shopping->drop_street) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_street))) !!}
									@endif
                                    @if(strlen($shopping->drop_postal_code) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_postal_code))) !!} 
									@endif
                                    @if(strlen($shopping->drop_city) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_city))) !!},
									@endif
                                    @if(strlen($shopping->drop_country) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_country))) !!}
									@endif
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <strong>{{ __('frontend/shop.need_help') }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <strong>{{ __('frontend/shop.orders.order_summary') }}</strong><br>
                                    {{ __('frontend/shop.total_price') }} {{ $shopping->getFormattedPrice( $shopping->total_price) }}
                                    <br>
                                    {{ __('frontend/shop.delivery') }}: {{ $shopping->getFormattedPrice( $shopping->delivery_price) }}
                                    <hr>
                                    {{ __('frontend/shop.total') }}: <strong>{{ $shopping->getFormattedPriceWithShipping() }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            @else
                <div class="alert alert-warning">
                    {{ __('frontend/user.orders_page.no_orders_exists') }}
                </div>  
            @endif
        </div>
    </div>
</div>
@endsection
