<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/system.payments.title')); ?></h3>
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
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/system.payments.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-system-payments-form')); ?>">
													<?php echo csrf_field(); ?>
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="payments_bitcoin_api"><?php echo e(__('backend/system.payments.bitcoin_api')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('payments_bitcoin_api')): ?> is-invalid <?php endif; ?>" id="payments_bitcoin_api" name="payments_bitcoin_api" placeholder="<?php echo e(__('backend/system.payments.bitcoin_api_placeholder')); ?>" value="" />
																
																<?php if($errors->has('payments_bitcoin_api')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('payments_bitcoin_api')); ?></strong>
																	</span>
																<?php endif; ?>

																<?php if(!App\Classes\BitcoinAPI::connected()): ?>
																<span class="invalid-feedback" style="margin-top:10px;display:block;" role="alert">
																	<strong><?php echo e(__('backend/system.payments.status')); ?> <?php echo e(__('backend/system.payments.failed')); ?></strong>
																</span>
																<?php endif; ?>
																
																<?php if(App\Classes\BitcoinAPI::connected()): ?>
																<span class="valid-feedback" style="margin-top:10px;display:block;" role="alert">
																	<strong><?php echo e(__('backend/system.payments.status')); ?> <?php echo e(__('backend/system.payments.connected')); ?></strong>
																</span>
																<?php endif; ?>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/system.payments.submit_button')); ?></button>
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
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/system/payments.blade.php ENDPATH**/ ?>