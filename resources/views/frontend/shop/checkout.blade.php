@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/v4.checkout_title') }}</h3>

			@if(!\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id))
            <div class="alert alert-warning">
                {{ __('frontend/shop.start_video_alert') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('frontend/v4.confirm_order') }}</div>
                    <div class="card-body">
						@if(count(\Auth::user()->getCheckoutCoupons()) <= 0)
							<b>Hast du einen Gutscheincode?</b>
							<form method="POST" action="{{ route('redeem-coupon-checkout') }}">
								@csrf
								<input autofocus type="text" class="form-control{{ $errors->has('coupon_code') ? ' is-invalid' : '' }}" value="{{ old('coupon_code') }}" name="coupon_code" />
								@if ($errors->has('coupon_code'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('coupon_code') }}</strong>
									</span>
								@endif
								<input type="submit" class="btn btn-secondary mt-15" value="Einlösen" />
							</form>
						@else
							<b>Dein Gutscheincode: </b>{{ strtoupper(\Auth::user()->getCheckoutCoupons()[0]->coupon_code) }}<br />
							<a href="{{ route('remove-coupon-checkout') }}">Anderen Gutschein verwenden</a>
						@endif
						<hr />

						<form method="POST" action="{{ route('checkout-form') }}">
							@csrf

							@if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id))
							<b>{{ __('frontend/v4.checkoutinfo1') }}</b>
							
							<hr />

							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									
									<b>{{ __('frontend/shop.delivery_method.title') }}</b><br /><br />
									
									@php 
										$delivery_methods = App\Models\DeliveryMethod::all()
									@endphp
									<select class="form-control" id="delivery_method_sel" name="product_delivery_method">
										<option value="">{{ __('frontend/shop.delivery_method.select_delivery_method') }}</option>
										@foreach(App\Models\DeliveryMethod::all() as $deliveryMethod)
											@if($deliveryMethod->isAvailableForUsersCart())
												<option value="{{ $deliveryMethod->id }}" >
													{{ __('frontend/shop.delivery_method.row', [
														'name' => $deliveryMethod->name,
														'price' => $deliveryMethod->getFormattedPrice()
													]) }}
												</option>
											@endif
										<!-- <label class="k-radio k-radio--all k-radio--solid">
											<input type="radio" name="product_delivery_method" value="{{ $deliveryMethod->id }}" data-content-visible="false" data-weight-visible="false" @if(!$deliveryMethod->isAvailableForUsersCart()) disabled @endif 
											data-delivery-price="{{ $deliveryMethod->price }}" />
											<span></span>
											{{ __('frontend/shop.delivery_method.row', [
												'name' => $deliveryMethod->name,
												'price' => $deliveryMethod->getFormattedPrice()
											]) }}
										
											@if(!$deliveryMethod->isAvailableForUsersCart())
											<div class="delivery-method-info">
												{{ __('frontend/shop.delivery_method.minmaxinfo', [
													'min' => $deliveryMethod->getFormattedMinAmount(),
													'max' => $deliveryMethod->getFormattedMaxAmount()
												]) }}
											</div>
											@endif
										</label><br /> -->
									@endforeach
									</select>
								</li>
							</ul>

							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<b>{{ __('frontend/shop.order_note') }}</b>
									<div class="row">
										<div class="col-sm-6 form-group">
											<label for="drop_name">{{ __('frontend/shop.drop.name') }}</label>
											<input class="form-control" name="drop_name" id="drop_name" placeholder="" value="{{ old('drop_name') ?? \Session::get('dropName') ?? '' }}" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_street">{{ __('frontend/shop.drop.street') }}</label>
											<input class="form-control" name="drop_street" id="drop_street" placeholder="" value="{{ old('drop_street') ?? \Session::get('dropStreet') ?? '' }}" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_postal_code">{{ __('frontend/shop.drop.postal_code') }}</label>
											<input class="form-control" name="drop_postal_code" id="drop_postal_code" placeholder="" value="{{ old('drop_postal_code') ?? \Session::get('dropPostalCode') ?? '' }}">
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_city">{{ __('frontend/shop.drop.city') }}</label>
											<input class="form-control" name="drop_city" id="drop_city" placeholder="" value="{{ old('drop_city') ?? \Session::get('dropCity') ?? '' }}" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_country">{{ __('frontend/shop.drop.country') }}</label>
											<input class="form-control" name="drop_country" id="drop_country" placeholder="" value="{{ old('drop_country') ?? \Session::get('dropCountry') ?? '' }}" required>
										</div>
									</div>
								</li>
							</ul>

							<hr />
							@endif
							
							<b>{{ __('frontend/v4.carttotal') }} </b><br />
							<span id="total_price" data-total_price = "{{ \App\Models\UserCart::getCartSubInCent(\Auth::user()->id) }}">{{ \App\Models\UserCart::getCartSubPrice(\Auth::user()->id, false) }}</span>  <br />
							<br />

							@if(count(Auth::user()->getCheckoutCoupons()) > 0)
								<b>{{ __('frontend/v4.amount_rabatt') }} </b><br />
								{{ \App\Models\UserCart::getCartRabatt(\Auth::user()->id) }} <br />
								<br />
							@endif

							<b>{{ __('frontend/v4.amount_to_pay') }} </b><br />
							<span id="amount_pay" data-amount_pay = "{{ \App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id) }}">
								{{ \App\Classes\Rabatt::priceformat(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id)) }} 
							</span><br />
							

							@if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id))
								<i>{{ __('frontend/v4.zzglversand') }}</i>
								<span id="shipping_cost"></span>
							@endif
							
							<br />
							<br />

							<hr />
						
							<input type="submit" value="{{ __('frontend/v4.buyconfirmbtn') }}" class="btn btn-primary" />
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page_scripts')
<script type="text/javascript">
	$(function() {
        // $("input[name=product_delivery_method]").on("click", function(){
		// 	const shipping_price = parseInt($("input[name=product_delivery_method]:checked").attr("data-delivery-price"));
		// 	let total_price = parseInt($("#total_price").attr('data-total_price'));

		// 	$("#total_price").html(getFormattedPriceFromCent(total_price + shipping_price) + " EUR");
		// 	$("#shipping_cost").html("(+" + getFormattedPriceFromCent(shipping_price) + " EUR)");
		// })
		var delivery_methods = [];
		@foreach($delivery_methods as $method)
			delivery_methods.push({'id' : {{$method->id}}, 'price': {{$method->price}} });
		@endforeach

		$("#delivery_method_sel").on("change", function(){
			const sel_method_id = $(this).val();
			delivery_methods.forEach((item) => {
				if(item.id == sel_method_id) {
					const shipping_price = item.price;
					let total_price = parseInt($("#total_price").attr('data-total_price'));

					$("#total_price").html(getFormattedPriceFromCent(total_price + shipping_price) + " EUR");
					$("#shipping_cost").html("(+" + getFormattedPriceFromCent(shipping_price) + " EUR)");
					return;
				}
			})
		})

		$("#delivery_method_sel").trigger("change");
  	});
</script>
@endsection