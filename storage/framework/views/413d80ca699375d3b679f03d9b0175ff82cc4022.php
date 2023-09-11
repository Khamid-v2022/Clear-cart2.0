<?php $__env->startSection('content'); ?>
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Shopping #<?php echo e($shopping->id); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-orders')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/orders.title')); ?></a>
										</div>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">Bestellungen</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<table class="table table-head-noborder">
														<thead>
															<tr>
																<th><?php echo e(__('backend/orders.table.id')); ?></th>
																<th><?php echo e(__('backend/orders.table.product')); ?></th>
																<th><?php echo e(__('backend/orders.table.user')); ?></th>
																<th><?php echo e(__('backend/orders.table.date')); ?></th>
																<!-- <th><?php echo e(__('backend/orders.table.delivery_method')); ?></th> -->
																<!-- <th><?php echo e(__('backend/orders.table.notes')); ?></th> -->
																<th><?php echo e(__('backend/orders.table.status')); ?></th>
																<th><?php echo e(__('backend/orders.table.amount')); ?></th>
																<th><?php echo e(__('backend/orders.table.actions')); ?></th>
															</tr>
														</thead>
														<tbody>
															<?php 
																$index = 0;
															?>
															
															<?php $__currentLoopData = $shopping->getOrders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php 
																$index++;
															?>
															<tr>
																<th scope="row"><?php echo e($index); ?></th>
																<td><?php echo e($order->name); ?></td>
																<td>
																	<?php echo e($order->getUser()->username); ?>

																</td>
																<td>
																	<?php echo e($order->created_at->format('d.m.Y H:i')); ?>

																</td>
																<!-- <td>
																	<?php if($order->delivery_method): ?>
																		<?php echo e($order->delivery_method); ?>

																	<?php endif; ?>
																</td>
																<td>
																	<?php if(strlen($order->drop_info) > 0): ?>
																		<?php echo nl2br(e(decrypt($order->drop_info))); ?>

																	<?php endif; ?>
																</td> -->
																<td>
																	<?php if($order->getStatus() == 'cancelled'): ?>
																		<?php echo e(__('backend/orders.status.cancelled')); ?>

																	<?php elseif($order->getStatus() == 'completed'): ?>
																		<?php echo e(__('backend/orders.status.completed')); ?>

																	<?php elseif($order->getStatus() == 'pending'): ?>
																	<?php echo e(__('backend/orders.status.pending')); ?>

																	<?php endif; ?>
																</td>
																<td>
																	<?php if($order->weight > 0): ?>
																		<?php echo e($order->weight); ?><?php echo e($order->weight_char); ?>

																	<?php elseif($order->is_variant_type): ?>
                                                						<?php echo e($order->getVariant() -> title); ?>

																	<?php else: ?>
																	<?php echo e($order->getAmount()); ?>

																	<?php endif; ?>
																</td>
																<td style="font-size: 20px;">
																	<a href="<?php echo e(route('backend-order-id', $order->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/orders.view')); ?>"><i class="la la-eye"></i></a>
																	
																	<?php if($order->getStatus() != 'completed' && $order->getStatus() != 'cancelled'): ?>
																	<a href="<?php echo e(route('backend-order-complete', $order->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/orders.complete')); ?>"><i class="la la-check"></i></a>
																	<?php endif; ?>
																	
																	<?php if($order->getStatus() != 'cancelled'): ?>
																	<a href="<?php echo e(route('backend-order-cancel', $order->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/orders.cancel')); ?>"><i class="la la-close"></i></a>
																	<?php endif; ?>
																	
																	<a href="<?php echo e(route('backend-order-delete', $order->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/orders.delete')); ?>"><i class="la la-trash"></i></a>
																</td>
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6 col-sm-12">
										<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/orders.shipping.shipping_method')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div>
														<strong class="text-"><?php echo e(__('backend/orders.table.delivery_method')); ?>:</strong> <span><?php echo e($shopping->delivery_method); ?></span>
													</div>
													<div>
														<strong class=""><?php echo e(__('backend/orders.table.notes')); ?>:</strong> 
														<span>
															<?php if(strlen($shopping->drop_info) > 0): ?>
																<?php echo nl2br(e(decrypt($shopping->drop_info))); ?>

															<?php endif; ?>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/orders/show2.blade.php ENDPATH**/ ?>