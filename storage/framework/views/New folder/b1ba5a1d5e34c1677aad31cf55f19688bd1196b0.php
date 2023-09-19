<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.orders')); ?></h3>

            <?php if(count($user_orders)): ?>
                <div id="orderAccordion" class="mb-15 accordion-with-icon">
                    <?php $__currentLoopData = $user_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-15" id="orderHeading-<?php echo e($loop->iteration); ?>">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#orderCollapse-<?php echo e($loop->iteration); ?>" aria-expanded="<?php if($loop->iteration == 1): ?> true <?php else: ?> false <?php endif; ?>" aria-controls="orderCollapse-<?php echo e($loop->iteration); ?>">
                                        <strong class="">#<?php echo e($order->id); ?></strong> <?php echo e($order->name); ?>

                                    </button>
                                </h5>
                            </div>

                            <div id="orderCollapse-<?php echo e($loop->iteration); ?>" class="collapse <?php if($loop->iteration == 1): ?> show <?php endif; ?>" aria-labelledby="orderHeading-<?php echo e($loop->iteration); ?>" data-parent="#orderAccordion">
                                <div class="card-body">
                                    <textarea class="form-control" rows="15"><?php $__empty_1 = true; $__currentLoopData = explode('\r\n\r\n', $order->content); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php echo e(strlen($content) ? str_replace(' |  | ', ' | ', preg_replace('#(\r\n|\r|\n)#',' | ',trim(decrypt($content)))) . PHP_EOL . '---------' . PHP_EOL : ''); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> N/A <?php endif; ?></textarea>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <?php if($order->getAmount() > 1): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.order_amount')); ?></b> <?php echo e($order->getAmount()); ?>

                                    </li>
                                    <?php endif; ?>

                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.price')); ?></b> <?php echo e($order->getFormattedPrice()); ?>

                                    </li>

                                    <?php if($order->delivery_price > 0): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.delivery_price')); ?></b> <?php echo e($order->getFormattedDeliveryPrice()); ?>

                                    </li>
                                    <?php endif; ?>

                                    <?php if($order->asWeight()): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.bought_weight')); ?></b> <?php echo e($order->getWeight() . $order->getWeightChar()); ?>

                                    </li>
                                    <?php endif; ?>
                                    
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.totalprice')); ?></b> <?php echo e($order->getFormattedTotalPrice()); ?>

                                    </li>

                                    <?php if(strlen($order->delivery_method) > 0): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.delivery_method.title')); ?></b>  
                                        <?php echo e($order->delivery_method); ?>

                                    </li>
                                    <?php endif; ?>

                                    <?php if(strlen($order->getDrop()) > 0): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.orders_order_note')); ?></b><br />
                                        <p style="margin-top: 8px">
                                            <?php echo nl2br(e(decrypt($order->getDrop()))); ?>

                                        </p>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($order->getStatus() != 'nothing'): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.orders_status')); ?></b>  
                                        <?php if($order->getStatus() == 'cancelled'): ?>
											<?php echo e(__('frontend/shop.orders.status.cancelled')); ?>

									    <?php elseif($order->getStatus() == 'completed'): ?>
									        <?php echo e(__('frontend/shop.orders.status.completed')); ?>

										<?php elseif($order->getStatus() == 'pending'): ?>
											<?php echo e(__('frontend/shop.orders.status.pending')); ?>

										<?php endif; ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($order->hasNotes()): ?>
                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/shop.orders_notes')); ?></b>
                                    </li>

                                    <?php $__currentLoopData = $order->getNotes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item list-group-order-note">
                                        <?php echo e(strlen($note->note) > 0 ? decrypt($note->note) : ''); ?>

                                        <span><?php echo e($note->getDateTime()); ?></span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <li class="list-group-item">
                                        <b><?php echo e(__('frontend/user.date')); ?></b> <?php echo e($order->created_at->format('d.m.Y')); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/frontend/userpanel/orders.blade.php ENDPATH**/ ?>