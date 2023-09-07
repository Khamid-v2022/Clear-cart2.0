<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.delivery_methods.add.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-delivery-methods')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.delivery_methods.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.delivery_methods.add.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-management-delivery-method-add-form')); ?>">
													<?php echo csrf_field(); ?>
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="delivery_method_add_name"><?php echo e(__('backend/management.delivery_methods.name')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('delivery_method_add_name')): ?> is-invalid <?php endif; ?>" id="delivery_method_add_name" name="delivery_method_add_name" placeholder="<?php echo e(__('backend/management.delivery_methods.name')); ?>" value="<?php echo e(old('delivery_method_add_name')); ?>" />

																<?php if($errors->has('delivery_method_add_name')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('delivery_method_add_name')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="delivery_method_add_price"><?php echo e(__('backend/management.delivery_methods.price')); ?></label>
																<input type="number" class="form-control <?php if($errors->has('delivery_method_add_price')): ?> is-invalid <?php endif; ?>" id="delivery_method_add_price" name="delivery_method_add_price" placeholder="<?php echo e(__('backend/management.delivery_methods.price')); ?>" value="<?php echo e(old('delivery_method_add_price')); ?>" />

																<?php if($errors->has('delivery_method_add_price')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('delivery_method_add_price')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="delivery_method_add_min_amount"><?php echo e(__('backend/management.delivery_methods.min_amount')); ?></label>
																<input type="number" class="form-control <?php if($errors->has('delivery_method_add_min_amount')): ?> is-invalid <?php endif; ?>" id="delivery_method_add_min_amount" name="delivery_method_add_min_amount" placeholder="<?php echo e(__('backend/management.delivery_methods.min_amount')); ?>" value="<?php echo e(old('delivery_method_add_min_amount')); ?>" />

																<?php if($errors->has('delivery_method_add_min_amount')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('delivery_method_add_min_amount')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="delivery_method_add_max_amount"><?php echo e(__('backend/management.delivery_methods.max_amount')); ?></label>
																<input type="number" class="form-control <?php if($errors->has('delivery_method_add_max_amount')): ?> is-invalid <?php endif; ?>" id="delivery_method_add_max_amount" name="delivery_method_add_max_amount" placeholder="<?php echo e(__('backend/management.delivery_methods.max_amount')); ?>" value="<?php echo e(old('delivery_method_add_max_amount')); ?>" />

																<?php if($errors->has('delivery_method_add_max_amount')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('delivery_method_add_max_amount')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.delivery_methods.add.submit_button')); ?></button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>
<script type="text/javascript">
	$(function() {
		$('textarea.text-editor').froalaEditor({
			toolbarSticky: false,
			language: 'de',
      		theme: 'gray',
			toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', '|', 'fontFamily', 'fontSize', 'color', '|', 'emoticons', '|', 'insertLink', 'insertImage', '|', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html']
		});
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/delivery_methods/add.blade.php ENDPATH**/ ?>