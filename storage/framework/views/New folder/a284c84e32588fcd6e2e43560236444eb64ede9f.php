<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.tickets.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														<?php if(count($tickets)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/management.tickets.id')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.user')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.subject')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.category')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.status')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.date')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row"><?php echo e($ticket->id); ?></th>
																	<td>
																		<?php echo e($ticket->getUser()->username); ?>

																	</td>
																	<td><?php echo e($ticket->subject); ?></td>
																	<td><?php echo e($ticket->getCategory()->name); ?></td>
																	<td>
																		<?php if($ticket->isClosed()): ?>
																		<span class="kt-badge kt-badge--danger kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/management.tickets.status_data.closed')); ?></span>
																		<?php elseif($ticket->isReplied()): ?>
																		<span class="kt-badge kt-badge--brand kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/management.tickets.status_data.replied')); ?></span>
																		<?php else: ?>
																		<span class="kt-badge kt-badge--success kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/management.tickets.status_data.open')); ?></span>
																		<?php endif; ?>
																	</td>
																	<td>
																		<?php echo e($ticket->created_at->format('d.m.Y H:i')); ?>

																	</td>
																	<td style="font-size: 20px;">
																		<a href="<?php echo e(route('backend-management-ticket-edit', $ticket->id)); ?>"><i class="la la-edit"></i></a>
																		<a href="<?php echo e(route('backend-management-ticket-delete', $ticket->id)); ?>"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>

														<?php echo preg_replace('/' . $tickets->currentPage() . '\?page=/', '', $tickets->links()); ?>

														<?php else: ?>
														<i><?php echo e(__('backend/main.no_entries')); ?></i>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/management/tickets/list.blade.php ENDPATH**/ ?>