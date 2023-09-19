<?php $__env->startSection('content'); ?>
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/jabber.title')); ?></h3>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/jabber.newsletter.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="<?php echo e(route('backend-jabber-newsletter-form')); ?>" style="width: 100%;">
														<?php echo csrf_field(); ?>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_message"><?php echo e(__('backend/jabber.newsletter.message')); ?></label>
															<textarea style="width: 100%;" class="form-control <?php if($errors->has('jabber_message')): ?> is-invalid <?php endif; ?>" name="jabber_message" id="jabber_message" placeholder="<?php echo e(__('backend/jabber.newsletter.type_here')); ?>"><?php echo e(old('jabber_message')); ?></textarea>

															<?php if($errors->has('jabber_message')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('jabber_message')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="<?php echo e(__('backend/jabber.newsletter.submit_button')); ?>" />
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php if(Auth::user()->hasPermission('jabber_login')): ?>
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/jabber.login.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="<?php echo e(route('backend-jabber-login-form')); ?>" style="width: 100%;">
														<?php echo csrf_field(); ?>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_address"><?php echo e(__('backend/jabber.login.address')); ?></label>
															<input style="width: 100%;" class="form-control <?php if($errors->has('jabber_address')): ?> is-invalid <?php endif; ?>" name="jabber_address" id="jabber_address" placeholder="<?php echo e(__('backend/jabber.login.address_placeholder')); ?>" value="<?php echo e(App\Models\Setting::get('jabber.address')); ?>" />

															<?php if($errors->has('jabber_address')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('jabber_address')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_username"><?php echo e(__('backend/jabber.login.username')); ?></label>
															<input style="width: 100%;" class="form-control <?php if($errors->has('jabber_username')): ?> is-invalid <?php endif; ?>" name="jabber_username" id="jabber_username" placeholder="<?php echo e(__('backend/jabber.login.username')); ?>" value="<?php echo e(App\Models\Setting::get('jabber.username')); ?>" />

															<?php if($errors->has('jabber_username')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('jabber_username')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_password"><?php echo e(__('backend/jabber.login.password')); ?></label>
															<input style="width: 100%;" class="form-control <?php if($errors->has('jabber_password')): ?> is-invalid <?php endif; ?>" name="jabber_password" id="jabber_password" placeholder="<?php echo e(__('backend/jabber.login.password')); ?>" value="<?php echo e(App\Models\Setting::get('jabber.password')); ?>" />

															<?php if($errors->has('jabber_password')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('jabber_password')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="<?php echo e(__('backend/jabber.login.save')); ?>" />
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/clearcart/resources/views/backend/jabber.blade.php ENDPATH**/ ?>