@extends('backend.layouts.default')

@section('content')
	<div class="k-content__head	k-grid__item">
		<div class="k-content__head-main">
			<h3 class="k-content__head-title">Shopping #{{ $shopping->id }}</h3>
			<div class="k-content__head-breadcrumbs">
				<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
				<span class="k-content__head-breadcrumb-separator"></span>
				<a href="{{ route('backend-orders') }}" class="k-content__head-breadcrumb-link">{{ __('backend/orders.title') }}</a>
			</div>
		</div>
	</div>

	<div class="k-content__body	k-grid__item k-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">Bestellungen</h3>
						</div>
					</div>
					<div class="k-portlet__body">
						<table class="table table-head-noborder">
							<thead>
								<tr>
									<th>{{ __('backend/orders.table.id') }}</th>
									<th>{{ __('backend/orders.table.product') }}</th>
									<th>{{ __('backend/orders.table.user') }}</th>
									<th>{{ __('backend/orders.table.date') }}</th>
									<!-- <th>{{ __('backend/orders.table.delivery_method') }}</th> -->
									<!-- <th>{{ __('backend/orders.table.notes') }}</th> -->
									<th>{{ __('backend/orders.table.status') }}</th>
									<th>{{ __('backend/orders.table.amount') }}</th>
									<th>{{ __('backend/orders.table.actions') }}</th>
								</tr>
							</thead>
							<tbody>
								@php 
									$index = 0;
								@endphp
								
								@foreach($shopping->getOrders() as $order)
								@php 
									$index++;
								@endphp
								<tr>
									<th scope="row">{{ $index }}</th>
									<td>{{ $order->name }}</td>
									<td>
										{{ $order->getUser()->username }}
									</td>
									<td>
										{{ $order->created_at->format('d.m.Y H:i') }}
									</td>
									<!-- <td>
										@if($order->delivery_method)
											{{ $order->delivery_method }}
										@endif
									</td>
									<td>
										@if(strlen($order->drop_info) > 0)
											{!! nl2br(e(decrypt($order->drop_info))) !!}
										@endif
									</td> -->
									<td>
										@if($order->getStatus() == 'cancelled')
											{{ __('backend/orders.status.cancelled') }}
										@elseif($order->getStatus() == 'completed')
											{{ __('backend/orders.status.completed') }}
										@elseif($order->getStatus() == 'pending')
										{{ __('backend/orders.status.pending') }}
										@endif
									</td>
									<td>
										@if($order->weight > 0)
											{{ $order->weight }}{{ $order->weight_char }}
										@elseif($order->is_variant_type)
											{{ $order->getVariant() -> title }}
										@else
										{{ $order->getAmount() }}
										@endif
									</td>
									<td style="font-size: 20px;">
										<a href="{{ route('backend-order-id', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.view') }}"><i class="la la-eye"></i></a>
										
										@if($order->getStatus() != 'completed' && $order->getStatus() != 'cancelled')
										<a href="{{ route('backend-order-complete', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.complete') }}"><i class="la la-check"></i></a>
										@endif
										
										@if($order->getStatus() != 'cancelled')
										<a href="{{ route('backend-order-cancel', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.cancel') }}"><i class="la la-close"></i></a>
										@endif
										
										<a href="{{ route('backend-order-delete', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.delete') }}"><i class="la la-trash"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">{{ __('backend/orders.shipping.shipping_method') }}</h3>
						</div>
					</div>
					<div class="k-portlet__body">
						<div>
							<strong class="text-">{{ __('backend/orders.table.delivery_method') }}:</strong> <span>{{ $shopping->delivery_method }}</span>
						</div>
						<div>
							<strong class="">{{ __('backend/orders.table.notes') }}:</strong> 
							<span>
								@if(strlen($shopping->drop_info) > 0)
									{!! nl2br(e(decrypt($shopping->drop_info))) !!}
								@endif
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_scripts')

@endsection