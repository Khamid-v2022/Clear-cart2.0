<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title"><?php echo e(__('frontend/user.deposit')); ?></h3>

            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/user.payment_methods')); ?></div>

                <div class="card-body">
                    <a href="<?php echo e(route('deposit-btc')); ?>" class="btn btn-warning btn-cashin <?php if(!App\Classes\BitcoinAPI::connected()): ?> disabled <?php endif; ?>"><?php echo e(__('frontend/user.cashin_btc_button')); ?></a>
                </div>
            </div>

            <div class="card mt-15">
                <div class="card-header"><?php echo e(__('frontend/user.coupon_redeem.title')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('redeem-coupon')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="coupon_redeem_code" class="text-md-right"><?php echo e(__('frontend/user.coupon_redeem.code')); ?></label>
                        <input id="coupon_redeem_code" type="text" class="form-control<?php echo e($errors->has('coupon_redeem_code') ? ' is-invalid' : ''); ?>" name="coupon_redeem_code" value="<?php echo e(old('coupon_redeem_code')); ?>" required autofocus>

                                <?php if($errors->has('coupon_redeem_code')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('coupon_redeem_code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('frontend/user.coupon_redeem.submit')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/userpanel/deposit.blade.php ENDPATH**/ ?>