

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">Order Details</h3>

            <?php if($shopping): ?>
                <div class="card">
                    <div class="card-header">Order ID: #<?php echo e($shopping -> id); ?> - <?php echo e($shopping -> created_at); ?></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-transactions table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo e(__('frontend/shop.transaction_id')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/v4.product')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.order_amount')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.price')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.delivery_price')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.delivery_method.title')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.bought_weight')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.totalprice')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.orders_status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $shopping->getOrders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="">
                                            <td> #<?php echo e($order->id); ?></td>
                                            <td><?php echo e($order->name); ?></td>
                                            <td>
                                                <?php if($order->getAmount() > 1): ?>
                                                    <?php echo e($order->getAmount()); ?>

                                                <?php endif; ?>
                                                <?php if($order->variant_id): ?>
                                                    <?php echo e($order->getVariant()->title); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td> <?php echo e($order->getFormattedPrice()); ?> </td>
                                            <td> <?php echo e($order->getFormattedDeliveryPrice()); ?> </td>
                                            <td> <?php echo e($order->delivery_method); ?> </td>
                                            <td>
                                                <?php if($order->asWeight()): ?>
                                                    <?php echo e($order->getWeight() . $order->getWeightChar()); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($order->getFormattedTotalPrice()); ?>

                                            </td>
                                            <td>
                                                <?php if($order->getStatus() != 'nothing'): ?>
                                                    <?php if($order->getStatus() == 'cancelled'): ?>
                                                        <?php echo e(__('frontend/shop.orders.status.cancelled')); ?>

                                                    <?php elseif($order->getStatus() == 'completed'): ?>
                                                        <?php echo e(__('frontend/shop.orders.status.completed')); ?>

                                                    <?php elseif($order->getStatus() == 'pending'): ?>
                                                        <?php echo e(__('frontend/shop.orders.status.pending')); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
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