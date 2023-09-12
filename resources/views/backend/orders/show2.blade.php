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
									<th>{{ __('backend/orders.table.amount') }}</th>
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
										@if($order->weight > 0)
											{{ $order->weight }}{{ $order->weight_char }}
										@elseif($order->is_variant_type)
											{{ $order->getVariant() -> title }}
										@else
										{{ $order->getAmount() }}
										@endif
									</td>
									<!-- <td style="font-size: 20px;">
										<a href="{{ route('backend-order-id', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.view') }}"><i class="la la-eye"></i></a>
										
										@if($order->getStatus() != 'completed' && $order->getStatus() != 'cancelled')
										<a href="{{ route('backend-order-complete', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.complete') }}"><i class="la la-check"></i></a>
										@endif
										
										@if($order->getStatus() != 'cancelled')
										<a href="{{ route('backend-order-cancel', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.cancel') }}"><i class="la la-close"></i></a>
										@endif
										
										<a href="{{ route('backend-order-delete', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.delete') }}"><i class="la la-trash"></i></a>
									</td> -->
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
							<strong class="">{{ __('backend/orders.table.delivery_method') }}:</strong> <span>{{ $shopping->delivery_method }}</span>
						</div>
						<div>
							<strong class="">{{ __('backend/orders.table.notes') }}:</strong>
							<div class="ml-3">
								<label>{{ __('backend/orders.shipping.drop.name') }}:</label> 
								<span>
									@if(strlen($shopping->drop_name) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_name))) !!}
									@endif
								</span><br>
								<label>{{ __('backend/orders.shipping.drop.street') }}:</label> 
								<span>
									@if(strlen($shopping->drop_street) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_street))) !!}
									@endif
								</span><br>
								<label>{{ __('backend/orders.shipping.drop.postal_code') }}:</label> 
								<span>
									@if(strlen($shopping->drop_postal_code) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_postal_code))) !!} 
									@endif
								</span><br>
								<label>{{ __('backend/orders.shipping.drop.city') }}:</label> 
								<span>
									@if(strlen($shopping->drop_city) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_city))) !!}
									@endif
								</span><br>
								<label>{{ __('backend/orders.shipping.drop.country') }}:</label> 
								<span>
									@if(strlen($shopping->drop_country) > 0) 
										{!! nl2br(e(decrypt($shopping->drop_country))) !!}
									@endif
								</span>
							</div> 
						</div>
						<div>
							<strong class="">{{ __('backend/orders.shipping.delivery_price') }}:</strong>
							<span>
								{{ $shopping->getFormattedPrice($shopping->delivery_price) }}
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-sm-12">
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">Overview</h3>
						</div>
					</div>
					<div class="k-portlet__body">
						<div>
							<strong class="text-">{{ __('backend/orders.total_price') }}:</strong> <span>{{ $shopping->getFormattedPrice($shopping->total_price) }}</span>
						</div>
						<div>
							<strong class="text-">{{ __('backend/orders.date_time') }}:</strong> <span>{{ $shopping->created_at->format('d.m.Y H:i')  }}</span>
						</div>
						<div>
							<strong class="text-">{{ __('backend/orders.user_name') }}:</strong> <span>{{ $shopping->getUser()->username }}</span>
						</div>
						<div>
							<strong class="">{{ __('backend/orders.table.status') }}:</strong> 
							<span>
								{{ $shopping->isDone() ? 'Ja' : 'Nein' }}
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