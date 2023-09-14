<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title"><?php echo e(__('frontend/v4.checkout_title')); ?></h3>

			<?php if(!\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id)): ?>
            <div class="alert alert-warning">
                <?php echo e(__('frontend/shop.start_video_alert')); ?>

            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/v4.confirm_order')); ?></div>
                    <div class="card-body">
						<?php if(count(\Auth::user()->getCheckoutCoupons()) <= 0): ?>
							<b>Hast du einen Gutscheincode?</b>
							<form method="POST" action="<?php echo e(route('redeem-coupon-checkout')); ?>">
								<?php echo csrf_field(); ?>
								<input autofocus type="text" class="form-control<?php echo e($errors->has('coupon_code') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('coupon_code')); ?>" name="coupon_code" />
								<?php if($errors->has('coupon_code')): ?>
									<span class="invalid-feedback" role="alert">
										<strong><?php echo e($errors->first('coupon_code')); ?></strong>
									</span>
								<?php endif; ?>
								<input type="submit" class="btn btn-secondary mt-15" value="Einlösen" />
							</form>
						<?php else: ?>
							<b>Dein Gutscheincode: </b><?php echo e(strtoupper(\Auth::user()->getCheckoutCoupons()[0]->coupon_code)); ?><br />
							<a href="<?php echo e(route('remove-coupon-checkout')); ?>">Anderen Gutschein verwenden</a>
						<?php endif; ?>
						<hr />

						<form method="POST" action="<?php echo e(route('checkout-form')); ?>">
							<?php echo csrf_field(); ?>

							<?php if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id)): ?>
							<b><?php echo e(__('frontend/v4.checkoutinfo1')); ?></b>
							
							<hr />

							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									
									<b><?php echo e(__('frontend/shop.delivery_method.title')); ?></b><br /><br />
									
									<?php 
										$delivery_methods = App\Models\DeliveryMethod::all()
									?>
									<select class="form-control">
										<?php $__currentLoopData = App\Models\DeliveryMethod::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($deliveryMethod->isAvailableForUsersCart()): ?>
												<option value="<?php echo e($deliveryMethod->id); ?>" id="delivery_methid_sel"  name="product_delivery_method">
													<?php echo e(__('frontend/shop.delivery_method.row', [
														'name' => $deliveryMethod->name,
														'price' => $deliveryMethod->getFormattedPrice()
													])); ?>

												</option>
											<?php endif; ?>
										<!-- <label class="k-radio k-radio--all k-radio--solid">
											<input type="radio" name="product_delivery_method" value="<?php echo e($deliveryMethod->id); ?>" data-content-visible="false" data-weight-visible="false" <?php if(!$deliveryMethod->isAvailableForUsersCart()): ?> disabled <?php endif; ?> 
											data-delivery-price="<?php echo e($deliveryMethod->price); ?>" />
											<span></span>
											<?php echo e(__('frontend/shop.delivery_method.row', [
												'name' => $deliveryMethod->name,
												'price' => $deliveryMethod->getFormattedPrice()
											])); ?>

										
											<?php if(!$deliveryMethod->isAvailableForUsersCart()): ?>
											<div class="delivery-method-info">
												<?php echo e(__('frontend/shop.delivery_method.minmaxinfo', [
													'min' => $deliveryMethod->getFormattedMinAmount(),
													'max' => $deliveryMethod->getFormattedMaxAmount()
												])); ?>

											</div>
											<?php endif; ?>
										</label><br /> -->
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</li>
							</ul>

							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<b><?php echo e(__('frontend/shop.order_note')); ?></b>
									<div class="row">
										<div class="col-sm-6 form-group">
											<label for="drop_name"><?php echo e(__('frontend/shop.drop.name')); ?></label>
											<input class="form-control" name="drop_name" id="drop_name" placeholder="" value="<?php echo e(old('drop_name') ?? \Session::get('dropName') ?? ''); ?>" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_street"><?php echo e(__('frontend/shop.drop.street')); ?></label>
											<input class="form-control" name="drop_street" id="drop_street" placeholder="" value="<?php echo e(old('drop_street') ?? \Session::get('dropStreet') ?? ''); ?>" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_postal_code"><?php echo e(__('frontend/shop.drop.postal_code')); ?></label>
											<input class="form-control" name="drop_postal_code" id="drop_postal_code" placeholder="" value="<?php echo e(old('drop_postal_code') ?? \Session::get('dropPostalCode') ?? ''); ?>">
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_city"><?php echo e(__('frontend/shop.drop.city')); ?></label>
											<input class="form-control" name="drop_city" id="drop_city" placeholder="" value="<?php echo e(old('drop_city') ?? \Session::get('dropCity') ?? ''); ?>" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_country"><?php echo e(__('frontend/shop.drop.country')); ?></label>
											<input class="form-control" name="drop_country" id="drop_country" placeholder="" value="<?php echo e(old('drop_country') ?? \Session::get('dropCountry') ?? ''); ?>" required>
										</div>
									</div>
								</li>
							</ul>

							<hr />
							<?php endif; ?>
							
							<b><?php echo e(__('frontend/v4.carttotal')); ?> </b><br />
							<span id="total_price" data-total_price = "<?php echo e(\App\Models\UserCart::getCartSubInCent(\Auth::user()->id)); ?>"><?php echo e(\App\Models\UserCart::getCartSubPrice(\Auth::user()->id, false)); ?></span>  <br />
							<br />

							<?php if(count(Auth::user()->getCheckoutCoupons()) > 0): ?>
								<b><?php echo e(__('frontend/v4.amount_rabatt')); ?> </b><br />
								<?php echo e(\App\Models\UserCart::getCartRabatt(\Auth::user()->id)); ?> <br />
								<br />
							<?php endif; ?>

							<b><?php echo e(__('frontend/v4.amount_to_pay')); ?> </b><br />
							<span id="amount_pay" data-amount_pay = "<?php echo e(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id)); ?>">
								<?php echo e(\App\Classes\Rabatt::priceformat(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id))); ?> 
							</span><br />
							

							<?php if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id)): ?>
								<i><?php echo e(__('frontend/v4.zzglversand')); ?></i>
								<span id="shipping_cost"></span>
							<?php endif; ?>
							
							<br />
							<br />

							<hr />
						
							<input type="submit" value="<?php echo e(__('frontend/v4.buyconfirmbtn')); ?>" class="btn btn-primary" />
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page_scripts'); ?>
<script type="text/javascript">
	$(function() {
        // $("input[name=product_delivery_method]").on("click", function(){
		// 	const shipping_price = parseInt($("input[name=product_delivery_method]:checked").attr("data-delivery-price"));
		// 	let total_price = parseInt($("#total_price").attr('data-total_price'));

		// 	$("#total_price").html(getFormattedPriceFromCent(total_price + shipping_price) + " EUR");
		// 	$("#shipping_cost").html("(+" + getFormattedPriceFromCent(shipping_price) + " EUR)");
		// })
		var delivery_methods = [];
		<?php $__currentLoopData = $delivery_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			delivery_methods.push({'id' : <?php echo e($method->id); ?>, 'price': <?php echo e($method->price); ?> });
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		console.log(delivery_methods);

		$("#delivery_methid_sel").on("change", function(){
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

		$("#delivery_methid_sel").trigger("change");
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/checkout.blade.php ENDPATH**/ ?>