<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.products.edit.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-management-products')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.products.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<?php if(!$product->isUnlimited()): ?>
											<a href="<?php echo e(route('backend-management-product-database', $product->id)); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px"><?php echo e(__('backend/management.products.edit.database')); ?></a>
											<?php endif; ?>
											
											<a href="<?php echo e(route('product-page', $product->id)); ?>" target="_shop_product_<?php echo e($product->id); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px"><?php echo e(__('backend/management.products.show_product')); ?></a>
											<a href="<?php echo e(route('backend-management-product-bonus', $product->id)); ?>" target="_shop_product_bonus_<?php echo e($product->id); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Bonus</a>
											
											<?php echo e(App\Classes\LangHelper::getLangSelector('lang-edit-product', $product->id, $lang ?? null)); ?>


											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.products.edit.title')); ?></h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="<?php echo e(route('backend-management-product-edit-form')); ?>">
													<?php echo csrf_field(); ?>


													<?php if($lang != null): ?>
													<input type="hidden" name="translation_lng" value="<?php echo e(strtolower($lang)); ?>" />
													<?php endif; ?>

													<input type="hidden" name="product_edit_id" value="<?php echo e($product->id); ?>" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
														<div class="form-group">
																<label for="product_edit_name"><?php echo e(__('backend/management.products.name')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_edit_name')): ?> is-invalid <?php endif; ?>" id="product_edit_name" name="product_edit_name" placeholder="<?php echo e(__('backend/management.products.name')); ?>" value="<?php echo e(\App\Classes\LangHelper::getValue($lang, 'product', 'name', $product->id) ?? $product->name); ?>" />

																<?php if($errors->has('product_edit_name')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_name')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<div class="form-group">
																<label for="product_edit_short_description"><?php echo e(__('backend/management.products.short_description')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_edit_short_description')): ?> is-invalid <?php endif; ?>" id="product_edit_short_description" name="product_edit_short_description" placeholder="<?php echo e(__('backend/management.products.short_description')); ?>" value="<?php echo e(\App\Classes\LangHelper::getValue($lang, 'product', 'short_description', $product->id) ?? (strlen($product->short_description) > 0 ? decrypt($product->short_description) : '')); ?>" />

																<?php if($errors->has('product_edit_short_description')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_short_description')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<?php if($lang == null): ?>
															<div class="form-group">
																<label for="product_edit_category_id"><?php echo e(__('backend/management.products.category')); ?></label>
																<select name="product_edit_category_id" id="product_edit_category_id" class="form-control <?php if($errors->has('product_edit_category_id')): ?> is-invalid <?php endif; ?>">
																	<option value="0"><?php echo e(__('backend/main.please_choose')); ?></option>
																	<?php $__currentLoopData = App\Models\ProductCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<option value="<?php echo e($productCategory->id); ?>" <?php if($product->category_id == $productCategory->id): ?> selected <?php endif; ?>><?php echo e($productCategory->name); ?></option>	
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																</select>

																<?php if($errors->has('product_edit_category_id')): ?>
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong><?php echo e($errors->first('product_edit_category_id')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															<?php endif; ?>

															<div class="form-group">
																<label for="product_edit_description"><?php echo e(__('backend/management.products.description')); ?></label>
																<textarea class="text-editor form-control <?php if($errors->has('product_edit_description')): ?> is-invalid <?php endif; ?>" id="product_edit_description" name="product_edit_description" placeholder="<?php echo e(__('backend/management.products.description')); ?>"><?php echo e(\App\Classes\LangHelper::getValue($lang, 'product', 'description', $product->id) ?? (strlen($product->description) > 0 ? decrypt($product->description) : '')); ?></textarea>

																<?php if($errors->has('product_edit_description')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_description')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<?php if($lang == null): ?>
															<div class="form-group">
																<label for="product_edit_price_in_cent"><?php echo e(__('backend/management.products.price_in_cent')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_edit_price_in_cent')): ?> is-invalid <?php endif; ?>" id="product_edit_price_in_cent" name="product_edit_price_in_cent" placeholder="<?php echo e(__('backend/management.products.price_in_cent_example')); ?>" value="<?php echo e($product->price_in_cent); ?>" />

																<?php if($errors->has('product_edit_price_in_cent')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_price_in_cent')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="form-group">
																<label for="product_edit_old_price_in_cent"><?php echo e(__('backend/management.products.old_price_in_cent')); ?></label>
																<input type="text" class="form-control <?php if($errors->has('product_edit_old_price_in_cent')): ?> is-invalid <?php endif; ?>" id="product_edit_old_price_in_cent" name="product_edit_old_price_in_cent" placeholder="<?php echo e(__('backend/management.products.old_price_in_cent_example')); ?>" value="<?php echo e($product->old_price_in_cent); ?>" />

																<?php if($errors->has('product_edit_old_price_in_cent')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_old_price_in_cent')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
															
															<div style="margin-bottom: 5px;">
																<label class="k-checkbox k-checkbox--all k-checkbox--solid">
																	<input type="checkbox" name="product_edit_drop_needed" value="1" data-content-visible="false" data-weight-visible="false" <?php if($product->dropNeeded()): ?> checked <?php endif; ?> />
																	<span></span>
																	<?php echo e(__('backend/management.products.edit.drop_needed')); ?>

																</label>
															</div>

															<div style="margin-bottom: 5px;">
																<b><?php echo e(__('backend/management.products.edit.options')); ?></b>
															</div>
															
															<div class="form-group">
																<label class="k-radio k-radio--all k-radio--solid">
																	<input type="radio" name="product_edit_stock_management" value="normal" data-content-visible="false" data-weight-visible="false" <?php if(!$product->isUnlimited() && !$product->asWeight()): ?> checked <?php endif; ?> />
																	<span></span>
																	<?php echo e(__('backend/management.products.edit.normal_stock_management')); ?>

																</label>
															</div>
															
															<div class="form-group">
																<label class="k-radio k-radio--all k-radio--solid">
																	<input type="radio" name="product_edit_stock_management" value="weight" data-content-visible="true" data-weight-visible="true" <?php if($product->asWeight()): ?> checked <?php endif; ?> />
																	<span></span>
																	<?php echo e(__('backend/management.products.edit.as_weight')); ?>

																</label>
															</div>
															
															<div class="form-group">
																<label class="k-radio k-radio--all k-radio--solid">
																	<input type="radio" name="product_edit_stock_management" value="unlimited" data-content-visible="true" data-weight-visible="false" <?php if($product->isUnlimited()): ?> checked <?php endif; ?> />
																	<span></span>
																	<?php echo e(__('backend/management.products.edit.unlimited_available')); ?>

																</label>
															</div>

															<div class="product_edit_weight_div form-group" style="<?php if(!$product->asWeight()): ?> display: none; <?php endif; ?>">
																<label for="product_edit_weight"><?php echo e(__('backend/management.products.weight')); ?></label>
																<input type="number" class="text-editor form-control <?php if($errors->has('product_edit_weight')): ?> is-invalid <?php endif; ?>" id="product_edit_weight" name="product_edit_weight" placeholder="<?php echo e(__('backend/management.products.weight')); ?>" value="<?php echo e($product->getWeightAvailable()); ?>" />

																<?php if($errors->has('product_edit_weight')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_weight')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>

															<div class="product_edit_weight_div form-group" style="<?php if(!$product->asWeight()): ?> display: none; <?php endif; ?>">
																<label for="product_edit_weightchar"><?php echo e(__('backend/management.products.weightchar')); ?></label>
																<input type="text" class="text-editor form-control <?php if($errors->has('product_edit_weightchar')): ?> is-invalid <?php endif; ?>" id="product_edit_weightchar" name="product_edit_weightchar" placeholder="<?php echo e(__('backend/management.products.weightchar')); ?>" value="<?php echo e($product->getWeightChar()); ?>" />

																<?php if($errors->has('product_edit_weightchar')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_weightchar')); ?></strong>
																	</span>
																<?php endif; ?>

																<div class="form-group" style="margin-top:20px">
																	<label for="product_edit_interval">Interval (nur für Produkte mit Gewichtangabe)</label>
																	<input type="number" class="form-control <?php if($errors->has('product_edit_interval')): ?> is-invalid <?php endif; ?>" id="product_edit_interval" name="product_edit_interval" placeholder="" value="<?php echo e($product->interval); ?>" />

																	<?php if($errors->has('product_edit_interval')): ?>
																		<span class="invalid-feedback" style="display:block" role="alert">
																			<strong><?php echo e($errors->first('product_edit_interval')); ?></strong>
																		</span>
																	<?php endif; ?>
																</div>
															</div>

															<div class="product_edit_content_div form-group" style="<?php if(!$product->isUnlimited() && !$product->asWeight()): ?> display: none; <?php endif; ?>">
																<label for="product_edit_content"><?php echo e(__('backend/management.products.content')); ?></label>
																<textarea class="text-editor form-control <?php if($errors->has('product_edit_content')): ?> is-invalid <?php endif; ?>" id="product_edit_content" name="product_edit_content" placeholder="<?php echo e(__('backend/management.products.content')); ?>"><?php echo e(strlen($product->content) > 0 ? decrypt($product->content) : ''); ?></textarea>

																<?php if($errors->has('product_edit_content')): ?>
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong><?php echo e($errors->first('product_edit_content')); ?></strong>
																	</span>
																<?php endif; ?>
															</div>
														<?php endif; ?>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.products.edit.submit_button')); ?></button>
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

		$('input[data-content-visible]').change(function() {
			if($(this).attr('data-content-visible') == 'true' && $(this).is(':checked')) {
				$('.product_edit_content_div').show();
			} else {
				$('.product_edit_content_div').hide();
			}
		});

		$('input[data-weight-visible]').change(function() {
			if($(this).attr('data-weight-visible') == 'true' && $(this).is(':checked')) {
				$('.product_edit_weight_div').show();
			} else {
				$('.product_edit_weight_div').hide();
			}
		});
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/products/edit.blade.php ENDPATH**/ ?>