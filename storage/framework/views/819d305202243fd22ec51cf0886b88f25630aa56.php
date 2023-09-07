<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Bonus</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/system.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">Bonus</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-system-bonus-form')); ?>">
													<?php echo csrf_field(); ?>
													
													<input type="hidden" name="settings_bonus_ids" value="<?php echo e($Ids); ?>" />
													<div class="kt-portlet__body">
														<?php $__currentLoopData = $bbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="kt-section kt-section--first row">
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_amount_<?php echo e($b->id); ?>">Min. Betrag</label>
																	<input type="text" class="form-control <?php if($errors->has('settings_bonus_amount_' . $b->id)): ?> is-invalid <?php endif; ?>" id="settings_bonus_amount_<?php echo e($b->id); ?>" name="settings_bonus_amount_<?php echo e($b->id); ?>" placeholder="100" value="<?php echo e($b->min_amount); ?>" />
																	
																	<?php if($errors->has('settings_bonus_amount_' . $b->id)): ?>
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong><?php echo e($errors->first('settings_bonus_amount_' . $b->id)); ?></strong>
																		</span>
																	<?php endif; ?>
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_percent_<?php echo e($b->id); ?>">Prozent</label>
																	<input type="text" class="form-control <?php if($errors->has('settings_bonus_percent_' . $b->id)): ?> is-invalid <?php endif; ?>" id="settings_bonus_percent_<?php echo e($b->id); ?>" name="settings_bonus_percent_<?php echo e($b->id); ?>" placeholder="0.90" value="<?php echo e($b->percent); ?>" />
																	
																	<?php if($errors->has('settings_bonus_percent_' . $b->id)): ?>
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong><?php echo e($errors->first('settings_bonus_percent_' . $b->id)); ?></strong>
																		</span>
																	<?php endif; ?>
																</div>
															</div>
															<div class="col-md-2" style="padding-top:27px">
																
																<a href="<?php echo e(route('backend-system-bonus-del', $b->id)); ?>" class="btn btn-danger">Löschen</a>
															</div>
														</div>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														
														<div class="kt-section kt-section--first row">
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_amount_new">Min. Betrag</label>
																	<input type="text" class="form-control <?php if($errors->has('settings_bonus_amount_new')): ?> is-invalid <?php endif; ?>" id="settings_bonus_amount_new" name="settings_bonus_amount_new" placeholder="100" value="" />
																	
																	<?php if($errors->has('settings_bonus_amount_new')): ?>
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong><?php echo e($errors->first('settings_bonus_amount_new')); ?></strong>
																		</span>
																	<?php endif; ?>
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_percent_new">Prozent</label>
																	<input type="text" class="form-control <?php if($errors->has('settings_bonus_percent_new')): ?> is-invalid <?php endif; ?>" id="settings_bonus_percent_new" name="settings_bonus_percent_new" placeholder="0.90" value="" />
																	
																	<?php if($errors->has('settings_bonus_percent_new')): ?>
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong><?php echo e($errors->first('settings_bonus_percent_new')); ?></strong>
																		</span>
																	<?php endif; ?>
																</div>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">Speichern</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/backend/system/bonus.blade.php ENDPATH**/ ?>