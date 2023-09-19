<?php $__env->startSection('content'); ?>
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.products.categories.add.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-products')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.products.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-products-categories')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.products.categories.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.products.categories.add.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-management-product-category-add-form')); ?>">
													<?php echo csrf_field(); ?>
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="product_category_add_name"><?php echo e(__('backend/management.products.categories.name')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_category_add_name')): ?> is-invalid <?php endif; ?>" id="product_category_add_name" name="product_category_add_name" placeholder="<?php echo e(__('backend/management.products.categories.name')); ?>" value="<?php echo e(old('product_category_add_name')); ?>" />

																<?php if($errors->has('product_category_add_name')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_category_add_name')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="product_category_add_slug"><?php echo e(__('backend/management.products.categories.slug')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_category_add_slug')): ?> is-invalid <?php endif; ?>" id="product_category_add_slug" name="product_category_add_slug" placeholder="<?php echo e(__('backend/management.products.categories.slug')); ?>" value="<?php echo e(old('product_category_add_slug')); ?>" />

																<?php if($errors->has('product_category_add_slug')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_category_add_slug')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="product_category_add_keywords"><?php echo e(__('backend/management.products.categories.keywords')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_category_add_keywords')): ?> is-invalid <?php endif; ?>" id="product_category_add_keywords" name="product_category_add_keywords" placeholder="<?php echo e(__('backend/management.products.categories.keywords')); ?>" value="<?php echo e(old('product_category_add_keywords')); ?>" />

																<?php if($errors->has('product_category_add_keywords')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_category_add_keywords')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<div class="form-group">
																<label for="product_category_add_meta_tags_desc"><?php echo e(__('backend/management.products.categories.meta_tags_desc')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_category_add_meta_tags_desc')): ?> is-invalid <?php endif; ?>" id="product_category_add_meta_tags_desc" name="product_category_add_meta_tags_desc" placeholder="<?php echo e(__('backend/management.products.categories.meta_tags_desc')); ?>" value="<?php echo e(old('product_category_add_meta_tags_desc')); ?>" />

																<?php if($errors->has('product_category_add_meta_tags_desc')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_category_add_meta_tags_desc')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.products.categories.add.submit_button')); ?></button>
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
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/products/categories/add.blade.php ENDPATH**/ ?>