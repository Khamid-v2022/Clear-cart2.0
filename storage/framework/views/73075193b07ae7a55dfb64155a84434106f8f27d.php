

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">Order Details</h3>

            <?php if($shopping): ?>
                <div class="card">
                    <div class="card-header text-center">
                        Order ID: #<?php echo e($shopping -> id); ?>

                    </div>
                    <div class="card-body">
                        <div>
                            <span class="text-muted"><?php echo e(__('frontend/shop.order_date')); ?>: </span> <?php echo e($shopping -> created_at->format('M j, Y')); ?>

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
                                    <?php $__currentLoopData = $shopping->getOrders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="">
                                        
                                        <td>
                                            <div class="d-flex">
                                                <?php if($product = $order->getProduct()): ?>
                                                    <?php if($main_img = $product->getMainImage()): ?>
                                                        <img src="<?php echo e('/files/' . $main_img->img_path); ?>" class="product-img-sm">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="product-detail">
                                                    <div><?php echo e($order->name); ?></div>
                                                    <div>
                                                        <span class="text-muted">
                                                            <?php if($order->variant_id): ?>
                                                                <?php echo e($order->getVariant()->title); ?>

                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end"> 
                                            <div>
                                                <?php echo e($order->getFormattedPrice()); ?> 
                                            </div>
                                            <div>
                                                Qty: 
                                                <span>
                                                    <?php if($order->variant_id): ?>
                                                        1
                                                    <?php else: ?>
                                                        <?php if($order->getAmount() > 1): ?>
                                                            <?php echo e($order->getAmount()); ?>

                                                        <?php elseif($order->asWeight()): ?>
                                                            <?php echo e($order->getWeight() . $order->getWeightChar()); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <strong><?php echo e(__('frontend/shop.payment')); ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <strong><?php echo e(__('frontend/shop.delivery')); ?></strong>
                                </div>
                                <div>
                                    <small><?php echo e(__('frontend/shop.delivery_method.address')); ?></small><br>
                                    <?php if(strlen($shopping->drop_street) > 0): ?> 
										<?php echo nl2br(e(decrypt($shopping->drop_street))); ?>

									<?php endif; ?>
                                    <?php if(strlen($shopping->drop_postal_code) > 0): ?> 
										<?php echo nl2br(e(decrypt($shopping->drop_postal_code))); ?> 
									<?php endif; ?>
                                    <?php if(strlen($shopping->drop_city) > 0): ?> 
										<?php echo nl2br(e(decrypt($shopping->drop_city))); ?>,
									<?php endif; ?>
                                    <?php if(strlen($shopping->drop_country) > 0): ?> 
										<?php echo nl2br(e(decrypt($shopping->drop_country))); ?>

									<?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <strong><?php echo e(__('frontend/shop.need_help')); ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <strong><?php echo e(__('frontend/shop.orders.order_summary')); ?></strong><br>
                                    <?php echo e(__('frontend/shop.total_price')); ?> <?php echo e($shopping->getFormattedPrice( $shopping->total_price)); ?>

                                    <br>
                                    <?php echo e(__('frontend/shop.delivery')); ?>: <?php echo e($shopping->getFormattedPrice( $shopping->delivery_price)); ?>

                                    <hr>
                                    <?php echo e(__('frontend/shop.total')); ?>: <strong><?php echo e($shopping->getFormattedPriceWithShipping()); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            <?php else: ?>
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/user.orders_page.no_orders_exists')); ?>

                </div>  
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/userpanel/order_details.blade.php ENDPATH**/ ?>