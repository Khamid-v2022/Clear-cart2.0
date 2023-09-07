<?php $__env->startSection('content'); ?>
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.tickets.categories.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-tickets')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.tickets.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="<?php echo e(route('backend-management-ticket-category-add')); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px"><?php echo e(__('backend/main.add')); ?></a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														<?php if(count($ticketsCategories)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/management.tickets.categories.id')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.categories.name')); ?></th>
																	<th><?php echo e(__('backend/management.tickets.categories.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $ticketsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticketCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row"><?php echo e($ticketCategory->id); ?></th>
																	<td><?php echo e($ticketCategory->name); ?></td>
																	<td style="font-size: 20px;">
																		<a href="<?php echo e(route('backend-management-ticket-category-edit', $ticketCategory->id)); ?>"><i class="la la-edit"></i></a>
																		<a href="<?php echo e(route('backend-management-ticket-category-delete', $ticketCategory->id)); ?>"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>
														<?php else: ?>
														<i><?php echo e(__('backend/main.no_entries')); ?></i>
														<?php endif; ?>

														<?php echo preg_replace('/' . $ticketsCategories->currentPage() . '\?page=/', '', $ticketsCategories->links()); ?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/tickets/categories/list.blade.php ENDPATH**/ ?>