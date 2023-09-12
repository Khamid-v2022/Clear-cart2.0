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

									<?php $__currentLoopData = App\Models\DeliveryMethod::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<label class="k-radio k-radio--all k-radio--solid">
											<input type="radio" name="product_delivery_method" value="<?php echo e($deliveryMethod->id); ?>" data-content-visible="false" data-weight-visible="false" <?php if(!$deliveryMethod->isAvailableForUsersCart()): ?> disabled <?php endif; ?> />
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
										</label><br />
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
											<label for="drop_city"><?php echo e(__('frontend/shop.drop.city')); ?></label>
											<input class="form-control" name="drop_city" id="drop_city" placeholder="" value="<?php echo e(old('drop_city') ?? \Session::get('dropCity') ?? ''); ?>" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_country"><?php echo e(__('frontend/shop.drop.country')); ?></label>
											<input class="form-control" name="drop_country" id="drop_country" placeholder="" value="<?php echo e(old('drop_country') ?? \Session::get('dropCountry') ?? ''); ?>" required>
										</div>
										<div class="col-sm-6 form-group">
											<label for="drop_postal_code"><?php echo e(__('frontend/shop.drop.postal_code')); ?></label>
											<input class="form-control" name="drop_postal_code" id="drop_postal_code" placeholder="" value="<?php echo e(old('drop_postal_code') ?? \Session::get('dropPostalCode') ?? ''); ?>">
										</div>
									</div>
								</li>
							</ul>

							<hr />
							<?php endif; ?>
							
							<b><?php echo e(__('frontend/v4.carttotal')); ?> </b><br />
							<?php echo e(\App\Models\UserCart::getCartSubPrice(\Auth::user()->id, false)); ?>  <br />
							<br />

							<?php if(count(Auth::user()->getCheckoutCoupons()) > 0): ?>
							<b><?php echo e(__('frontend/v4.amount_rabatt')); ?> </b><br />
							<?php echo e(\App\Models\UserCart::getCartRabatt(\Auth::user()->id)); ?> <br />
							<br />
							<?php endif; ?>
							<b><?php echo e(__('frontend/v4.amount_to_pay')); ?> </b><br />
							<?php echo e(\App\Classes\Rabatt::priceformat(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id))); ?> <br />
							

							<?php if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id)): ?>
							<i><?php echo e(__('frontend/v4.zzglversand')); ?></i>
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

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/checkout.blade.php ENDPATH**/ ?>