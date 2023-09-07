<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.users.edit.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-users')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.users.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12">
											<a href="<?php echo e(route('backend-management-user-tickets', $user->id)); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Alle Tickets</a>
											<a href="<?php echo e(route('backend-management-user-orders', $user->id)); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Alle Bestellungen</a>
											
											
										</div>
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/management.users.widget1.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label"><?php echo e(App\Models\UserTransaction::where('user_id', $user->id)->count()); ?></div>
															<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/management.users.widget2.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label"><?php echo e(App\Models\UserTicket::where('user_id', $user->id)->count()); ?></div>
															<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/management.users.widget3.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label"><?php echo e(App\Models\UserOrder::where('user_id', $user->id)->count()); ?></div>
															<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/management.users.widget4.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label"><?php echo e(App\Models\UserPermission::where('user_id', $user->id)->count()); ?></div>
															<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet">
												<div class="k-portlet__head k-portlet__head--lg k-portlet__head--noborder k-portlet__head--break-sm">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">
															Offene Tickets von <?php echo e(htmlspecialchars($user->username)); ?>

															<small>Insgesamt <?php echo e(count($tickets)); ?> offene Tickets</small>
														</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div class="k-datatable k-datatable--default k-datatable--brand k-datatable--error k-datatable--loaded k-datatable--scroll" id="k_recent_tickets">
														<table class="table">
															<thead class="">
																<tr>
																	<th>
																		<span>#</span>
																	</th>
																	<th>
																		<span>Betreff</span>
																	</th>
																	<th>
																		<span>Status</span>
																	</th>
																	<th>
																		<span>Datum</span>
																	</th>
																	<th style="text-align:right;">
																		<span>Aktionen</span>
																	</th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<td>
																		<?php echo e($ticket->id); ?>

																	</td>
																	<td>
																		<?php echo e(htmlspecialchars($ticket->subject)); ?>

																	</td>
																	<td>
																		<?php if($ticket->isClosed()): ?>
																		<span class="kt-badge kt-badge--danger kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.closed')); ?></span>
																		<?php elseif($ticket->isReplied()): ?>
																		<span class="kt-badge kt-badge--brand kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.replied')); ?></span>
																		<?php else: ?>
																		<span class="kt-badge kt-badge--success kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.open')); ?></span>
																		<?php endif; ?>
																	</td>	
																	<td>
																		<?php echo e($ticket->created_at->format('d.m.Y H:i')); ?>

																	</td>
																	<td style="text-align:right;">
																		<a href="<?php echo e(route('backend-management-ticket-edit', $ticket->id)); ?>" class="btn btn-clean  btn-sm btn-icon-md">
																			<i class="la la-edit"></i> <?php echo e(__('backend/dashboard.recent_tickets.edit')); ?>

																		</a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.users.edit.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-management-user-edit-form')); ?>">
													<?php echo csrf_field(); ?>

													<input type="hidden" value="<?php echo e($user->id); ?>" name="user_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="user_edit_name"><?php echo e(__('backend/management.users.name')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('user_edit_name')): ?> is-invalid <?php endif; ?>" id="user_edit_name" name="user_edit_name" placeholder="<?php echo e(__('backend/management.users.name')); ?>" value="<?php echo e($user->name); ?>" />

																<?php if($errors->has('user_edit_name')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('user_edit_name')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<div class="form-group">
																<label for="user_edit_username"><?php echo e(__('backend/management.users.username')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('user_edit_username')): ?> is-invalid <?php endif; ?>" id="user_edit_username" placeholder="<?php echo e(__('backend/management.users.username')); ?>" value="<?php echo e($user->username); ?>" disabled="true" />
															</div>

															<div class="form-group">
																<label for="user_edit_jabber"><?php echo e(__('backend/management.users.jabber')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('user_edit_jabber')): ?> is-invalid <?php endif; ?>" id="user_edit_jabber" name="user_edit_jabber" placeholder="<?php echo e(__('backend/management.users.jabber')); ?>" value="<?php echo e($user->jabber_id); ?>" />

																<?php if($errors->has('user_edit_jabber')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('user_edit_jabber')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="user_edit_balance"><?php echo e(__('backend/management.users.balance_in_cent')); ?></label>
																<input type="number" class="form-control <?php if($errors->has('user_edit_balance')): ?> is-invalid <?php endif; ?>" id="user_edit_balance" name="user_edit_balance" placeholder="<?php echo e(__('backend/management.users.balance')); ?>" value="<?php echo e($user->balance_in_cent); ?>" />

																<?php if($errors->has('user_edit_balance')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('user_edit_balance')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.users.edit.submit_button')); ?></button>
														</div>
													</div>
												</form>
											</div>
										</div>

										<?php if(Auth::user()->hasPermission('manage_users_permissions')): ?>
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.users.edit.permissions.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-management-user-update-permissions-form')); ?>">
													<?php echo csrf_field(); ?>

													<input type="hidden" value="<?php echo e($user->id); ?>" name="user_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<?php $__currentLoopData = App\Models\Permission::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<div class="form-group">
																<label class="k-checkbox k-checkbox--all k-checkbox--solid">
																	<input type="checkbox" name="user_edit_permissions[]" value="<?php echo e($permission->id); ?>" <?php if($user->hasPermission($permission->permission)): ?> checked <?php endif; ?> />
																	<span></span>
																	<?php if(\Lang::has('backend/permissions.' . $permission->permission)): ?>
																	<?php echo e(__('backend/permissions.' . $permission->permission)); ?>

																	<?php else: ?>
																	<?php echo e($permission->permission); ?>

																	<?php endif; ?>
																</label>
															</div>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.users.edit.save_button')); ?></button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/users/edit.blade.php ENDPATH**/ ?>