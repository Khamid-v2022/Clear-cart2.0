<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.users.title')); ?></h3>
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
														<?php if(count($users)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/management.users.id')); ?></th>
																	<!--
																	<th><?php echo e(__('backend/management.users.name')); ?></th>
																	-->	
																	<th><?php echo e(__('backend/management.users.username')); ?></th>
																	<th><?php echo e(__('backend/management.users.jabber')); ?></th>
																	<th><?php echo e(__('backend/management.users.newsletter_enabled')); ?></th>
																	<th><?php echo e(__('backend/management.users.balance')); ?></th>
																	<th><?php echo e(__('backend/management.users.date')); ?></th>
																	<th><?php echo e(__('backend/management.users.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row"><?php echo e($user->id); ?></th>
																	<!--
																	<td><?php echo e($user->name); ?></td>
																	-->
																	<td><?php echo e($user->username); ?></td>
																	<td><?php echo e($user->jabber_id); ?></td>
																	<td><?php echo e($user->newsletter_enabled == 1 ? __('backend/management.users.enabled') : __('backend/management.users.disabled')); ?></td>
																	<td><?php echo e($user->getFormattedBalance()); ?></td>
																	<td>
																		<?php echo e($user->created_at->format('d.m.Y H:i')); ?>

																	</td>
																	<td style="font-size: 20px;">
																		<a href="<?php echo e(route('backend-management-user-edit', $user->id)); ?>"><i class="la la-edit"></i></a>
																		<a href="<?php echo e(route('backend-management-user-delete', $user->id)); ?>"><i class="la la-trash"></i></a>
																		<a href="<?php echo e(route('backend-management-user-login', $user->id)); ?>"><i class="la la-sign-in"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>

														<?php echo preg_replace('/' . $users->currentPage() . '\?page=/', '', $users->links()); ?>

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
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/backend/management/users/list.blade.php ENDPATH**/ ?>