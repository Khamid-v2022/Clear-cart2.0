<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title"><?php echo e(__('frontend/v4.shopping_cart')); ?></h3>

            <?php if(!\App\Models\UserCart::isEmpty(\Auth::user()->id)): ?>
            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/v4.shopping_cart')); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-transactions table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('frontend/v4.product')); ?></th>
                                        <th scope="col"><?php echo e(__('frontend/v4.amount')); ?></th>
                                        <th scope="col"><?php echo e(__('frontend/v4.price')); ?></th>
                                        <th scope="col"><?php echo e(__('frontend/v4.total1')); ?></th>
                                        <th scope="col"><?php echo e(__('frontend/v4.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="">
                                        <td>
                                            <a href="<?php echo e(route('product-page', $cartItem[0]->id)); ?>"><?php echo e(htmlspecialchars($cartItem[0]->name)); ?></a>
                                        </td>
                                        <td>
                                            <?php if($cartItem[0]->asWeight()): ?>
                                                <?php echo e($cartItem[1]); ?><?php echo e($cartItem[0]->getWeightChar()); ?>

                                            <?php else: ?>
                                                <?php echo e($cartItem[1]); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($cartItem[0]->asVariant()): ?>
                                                <?php echo e(\App\Models\Product::getFormattedPriceFromCent($cartItem[2])); ?>

                                            <?php else: ?>
                                                <?php echo e($cartItem[0]->getFormattedPrice()); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(\App\Models\Product::getFormattedPriceFromCent($cartItem[2])); ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('cart-item-delete', $cartItem[0]->id)); ?>"><?php echo e(__('frontend/v4.remove')); ?></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <hr />

                            <a href="<?php echo e(route('cart-clear')); ?>" class="btn btn-secondary"><?php echo e(__('frontend/v4.clearcart')); ?></a>

                            <hr />
                            
                            <b><?php echo e(__('frontend/v4.subtotal')); ?> </b>
                            <?php echo e(\App\Models\UserCart::getCartSubPrice(\Auth::user()->id, false)); ?> 
                            <br />
                            
                            <b><?php echo e(__('frontend/v4.carttotal')); ?> </b>
                            <?php echo e(\App\Classes\Rabatt::priceformat(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id, false))); ?> <br />
							
                            <b><?php echo e(__('frontend/v4.amount_to_pay')); ?> </b>
                            <?php echo e(\App\Classes\Rabatt::priceformat(\App\Models\UserCart::getCartSubInCentCheckedCoupon(\Auth::user()->id))); ?> <br />
							
							<?php if(\App\Models\UserCart::hasDroplestProducts(\Auth::user()->id)): ?>
                            zzgl. Versandkosten
                            <?php endif; ?>
                            <hr />

                            <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary"><?php echo e(__('frontend/v4.continue_checkout')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('frontend/v4.cart_is_empty')); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/cart.blade.php ENDPATH**/ ?>