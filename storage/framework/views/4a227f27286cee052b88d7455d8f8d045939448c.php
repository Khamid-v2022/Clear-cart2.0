<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/design.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/design.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-design-form')); ?>">
													<?php echo csrf_field(); ?>
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="logo"><?php echo e(__('backend/design.logo')); ?></label>
																<br />
																<input id="logo" name="logo" class="form-control" value="<?php echo e(App\Models\Setting::get('theme.logo')); ?>" />
																<?php if($errors->has('logo')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('logo')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="favicon"><?php echo e(__('backend/design.favicon')); ?></label>
																<br />
																<input id="favicon" name="favicon" class="form-control" value="<?php echo e(App\Models\Setting::get('theme.favicon')); ?>" />
																<?php if($errors->has('favicon')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('favicon')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="background"><?php echo e(__('backend/design.background')); ?></label>
																<br />
																<input id="background" name="background" class="form-control" value="<?php echo e(App\Models\Setting::get('theme.background')); ?>" />
																<?php if($errors->has('background')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('background')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="pattern"><?php echo e(__('backend/design.pattern')); ?></label>
																<br />
																<input id="pattern" name="pattern" class="form-control" value="<?php echo e(App\Models\Setting::get('theme.color1')); ?>" />
																<?php if($errors->has('pattern')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('pattern')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="custom_css"><?php echo e(__('backend/design.custom_css')); ?></label>
																<br />
																<textarea id="custom_css" name="custom_css"><?php echo e(App\Models\Setting::get('theme.custom.css')); ?></textarea>
																<?php if($errors->has('custom_css')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('custom_css')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/design.submit_button')); ?></button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/hint/show-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/hint/css-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/mode/htmlmixed/htmlmixed.min.js"></script>
<script src=""></script>
<script>
   	CodeMirror.fromTextArea(document.getElementById('custom_css'), {
    	lineNumbers: true,
    	mode: 'css',
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/design/design.blade.php ENDPATH**/ ?>