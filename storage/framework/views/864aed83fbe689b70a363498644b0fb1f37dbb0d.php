

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.orders')); ?></h3>

            <?php if(count($user_orders)): ?>
                <div class="card">
                    <div class="card-header"><?php echo e(__('frontend/user.orders')); ?></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-transactions table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo e(__('frontend/v4.product')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/v4.price')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/v4.details')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $user_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_shopping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="">
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <?php if($first_order = $order_shopping->getFirstOrder()): ?>
                                                            <?php if($product = $first_order->getProduct()): ?>
                                                                <?php if($main_img = $product->getMainImage()): ?>
                                                                    <img src="<?php echo e('/files/' . $main_img->img_path); ?>" class="product-img-sm">
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <?php echo e(__('frontend/shop.order_id')); ?> <span class="text-danger">#<?php echo e($order_shopping->id); ?></span>
                                                        <div>
                                                        <?php $__currentLoopData = $order_shopping->getOrders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div>
                                                                <span class="product-name text-dark"><?php echo e($order->name); ?></span> 
                                                                <span class="product-quantity text-muted">
                                                                    <?php if($order->getAmount() > 1): ?>
                                                                        <?php echo e($order->getAmount()); ?>

                                                                    <?php endif; ?>
                                                                    <?php if($order->asWeight()): ?>
                                                                        <?php echo e($order->getWeight() . $order->getWeightChar()); ?>

                                                                    <?php endif; ?>
                                                                    <?php if($order->is_variant_type): ?>
                                                                    <?php echo e($order->getVariant()->title); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <?php echo e(\App\Models\Product::getFormattedPriceFromCent($order_shopping->total_price + $order_shopping->delivery_price)); ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('order-detail-page', $order_shopping->id)); ?>"><?php echo e(__('frontend/v4.details')); ?></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo preg_replace('/' . $user_orders->currentPage() . '\?page=/', '', $user_orders->links()); ?>

            <?php else: ?>
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/user.orders_page.no_orders_exists')); ?>

                </div>  
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/userpanel/orders.blade.php ENDPATH**/ ?>