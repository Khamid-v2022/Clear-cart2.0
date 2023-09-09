@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">Order Details</h3>

            @if($header_info)
                <div class="card">
                    <div class="card-header">Order ID: #{{ $header_info -> id }} - {{ $header_info -> created_at }}</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-transactions table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('frontend/shop.transaction_id') }}</th>
                                            <th scope="col">{{ __('frontend/v4.product') }}</th>
                                            <th scope="col">{{ __('frontend/shop.order_amount') }}</th>
                                            <th scope="col">{{ __('frontend/shop.price') }}</th>
                                            <th scope="col">{{ __('frontend/shop.delivery_price') }}</th>
                                            <th scope="col">{{ __('frontend/shop.delivery_method.title') }}</th>
                                            <th scope="col">{{ __('frontend/shop.bought_weight') }}</th>
                                            <th scope="col">{{ __('frontend/shop.totalprice') }}</th>
                                            <th scope="col">{{ __('frontend/shop.orders_status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_details as $order)
                                        <tr class="">
                                            <td> #{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                                @if($order->getAmount() > 1)
                                                    {{ $order->getAmount() }}
                                                @endif
                                            </td>
                                            <td> {{ $order->getFormattedPrice() }} </td>
                                            <td> {{ $order->getFormattedDeliveryPrice() }} </td>
                                            <td> {{ $order->delivery_method }} </td>
                                            <td>
                                                @if($order->asWeight())
                                                    {{ $order->getWeight() . $order->getWeightChar() }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->getFormattedTotalPrice() }}
                                            </td>
                                            <td>
                                                @if($order->getStatus() != 'nothing')
                                                    @if($order->getStatus() == 'cancelled')
                                                        {{ __('frontend/shop.orders.status.cancelled') }}
                                                    @elseif($order->getStatus() == 'completed')
                                                        {{ __('frontend/shop.orders.status.completed') }}
                                                    @elseif($order->getStatus() == 'pending')
                                                        {{ __('frontend/shop.orders.status.pending') }}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
