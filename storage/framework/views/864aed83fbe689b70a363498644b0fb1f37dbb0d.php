

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
                                            <th scope="col"><?php echo e(__('frontend/shop.order_id')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/user.date')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.orders_order_note')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.totalprice')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.delivery_method.title')); ?></th>
                                            <th scope="col"><?php echo e(__('frontend/shop.total_delivery_price')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $user_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="">
                                            <td>
                                                #<?php echo e($order_header->id); ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('order-detail-page', $order_header->id)); ?>"><?php echo e($order_header->created_at); ?></a>
                                            </td>
                                            <td>
                                                <?php echo e(decrypt($order_header->drop_info)); ?>

                                            </td>
                                            <td>
                                                <?php echo e($order_header->total_price); ?>

                                            </td>
                                            <td>
                                                <?php echo e($order_header->delivery_method); ?>

                                            </td>
                                            <td>
                                                <?php echo e($order_header->delivery_price); ?>

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