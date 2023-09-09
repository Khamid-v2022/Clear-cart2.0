@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.orders') }}</h3>

            @if(count($user_orders))
                <div class="card">
                    <div class="card-header">{{ __('frontend/user.orders') }}</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-transactions table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('frontend/shop.order_id') }}</th>
                                            <th scope="col">{{ __('frontend/user.date') }}</th>
                                            <th scope="col">{{ __('frontend/shop.orders_order_note') }}</th>
                                            <th scope="col">{{ __('frontend/shop.totalprice') }}</th>
                                            <th scope="col">{{ __('frontend/shop.delivery_method.title') }}</th>
                                            <th scope="col">{{ __('frontend/shop.total_delivery_price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_orders as $order_header)
                                        <tr class="">
                                            <td>
                                                #{{ $order_header->id }}
                                            </td>
                                            <td>
                                                <a href="{{ route('order-detail-page', $order_header->id) }}">{{ $order_header->created_at }}</a>
                                            </td>
                                            <td>
                                                {{ decrypt($order_header->drop_info) }}
                                            </td>
                                            <td>
                                                {{ $order_header->total_price }}
                                            </td>
                                            <td>
                                                {{ $order_header->delivery_method }}
                                            </td>
                                            <td>
                                                {{ $order_header->delivery_price }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {!! preg_replace('/' . $user_orders->currentPage() . '\?page=/', '', $user_orders->links()) !!}
            @else
                <div class="alert alert-warning">
                    {{ __('frontend/user.orders_page.no_orders_exists') }}
                </div>  
            @endif
        </div>
    </div>
</div>
@endsection
