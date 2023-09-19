

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

					<form method="post" class="kt-form" action="<?php echo e(route('backend-management-product-edit-form')); ?>"  enctype="multipart/form-data">
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
									<label for="product_img">Product Images</label>
									<input type="file" class="form-control" id="product_img" name="product_img[]" accept="image/*" multiple <?php if(count($product->getImages()) >= 3): ?> disabled <?php endif; ?>/>
									
									<div class="product-imgs-preview d-flex">
										<?php $__currentLoopData = $product->getImages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="product-img-item" data-img_id="<?php echo e($img->id); ?>">
												<img src="<?php echo e('/files/' . $img->img_path); ?>" class="product-img <?php if($img->is_main): ?> selected <?php endif; ?>" data-img_path="<?php echo e($img->img_path); ?>">
												<span class="delete-img-btn"><i class="la la-trash"></i></span>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<?php if($product->getMainImage()): ?>
										<input type="hidden" name="main_img_name" id="main_img_name" value="<?php echo e($product->getMainImage()->img_path); ?>">
									<?php else: ?>
										<input type="hidden" name="main_img_name" id="main_img_name" value="">
									<?php endif; ?>
									<input type="hidden" name="main_img_index" id="main_img_index" value="-1">
									<input type="hidden" name="deleted_img_ids" id="deleted_img_ids" value="">
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
								<!-- <div class="form-group">
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
								</div> -->

								<div style="margin-bottom: 5px;">
									<b><?php echo e(__('backend/management.products.edit.options')); ?></b>
								</div>
								
								<!-- <div class="form-group">
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
								</div> -->

								<!-- added by Khamid 2023-09-07 -->
								<div class="form-group">
									<label class="k-radio k-radio--all k-radio--solid">
										<input type="radio" name="product_edit_stock_management" value="variants" <?php if($product->asVariant()): ?> checked <?php endif; ?> />
										<span></span>
										<?php echo e(__('backend/management.products.add.variant')); ?>

									</label>
								</div>
								<div class="form-group">
									<label class="k-radio k-radio--all k-radio--solid">
										<input type="radio" name="product_edit_stock_management" value="tiered" <?php if($product->asTiered()): ?> checked <?php endif; ?> />
										<span></span>
										<?php echo e(__('backend/management.products.edit.tiered')); ?>

									</label>
								</div>
								<!-- / added by Khamid -->
								

								<!-- <div class="product_edit_weight_div form-group" style="<?php if(!$product->asWeight()): ?> display: none; <?php endif; ?>">
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
								</div> -->

								<!-- added by Khamid 2023-09-07 -->
								<div class="product_edit_variant_div"  style="<?php if(!$product->asVariant()): ?> display: none; <?php endif; ?>">
									<div class="row">
										<div class="col-9 variant-wrapper">
											<?php if(count($variants) > 0): ?>
												<?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="variant-item row">
													<div class="col-5">
														<div class="form-group">
															<label for=""><?php echo e(__('backend/management.products.title')); ?></label>
															<input type="text" class="form-control product-variant-title" name="product_edit_variant_title[]" value="<?php echo e($variant->title); ?>" />
														</div>
													</div>
													<div class="col-5">
														<div class="form-group">
															<label for=""><?php echo e(__('backend/management.products.price')); ?></label>
															<input type="number" step="any" class="form-control product-variant-price" name="product_edit_variant_price[]" value="<?php echo e($variant->price); ?>" />
														</div>
													</div>
													<div class="col-2">
														<a class="delete-variant cursor-pointer"><i class="la la-trash"></i></a>
													</div>
												</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<div class="variant-item row">
												<div class="col-5">
													<div class="form-group">
														<label for=""><?php echo e(__('backend/management.products.title')); ?></label>
														<input type="text" class="form-control product-variant-title" name="product_edit_variant_title[]" />
													</div>
												</div>
												<div class="col-5">
													<div class="form-group">
														<label for=""><?php echo e(__('backend/management.products.price')); ?></label>
														<input type="number" step="any" class="form-control product-variant-price" name="product_edit_variant_price[]" />
													</div>
												</div>
												<div class="col-2">
													<a class="delete-variant cursor-pointer"><i class="la la-trash"></i></a>
												</div>
											</div>
											<?php endif; ?>
										</div>
										<div class="col-3">
											<button class="btn btn-wide btn-bold btn-primary" id="add_variant_btn" type="button" style="margin-top:22px">Add</button>
										</div>
									</div>
								</div>

								<div class="product_edit_tiered_div"  style="<?php if(!$product->asTiered()): ?> display: none; <?php endif; ?>">
									<div class="row">
										<div class="col-9 tiered-wrapper">
											<?php if(count($tieredPrices) > 0): ?>
												<?php $__currentLoopData = $tieredPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="tiered-item row">
													<div class="col-5">
														<div class="form-group">
															<label for=""><?php echo e(__('backend/management.products.edit.amount')); ?></label>
															<input type="text" class="form-control product-tiered-amount" name="product_edit_tiered_amount[]" value="<?php echo e($price->amount); ?>" />
														</div>
													</div>
													<div class="col-5">
														<div class="form-group">
															<label for=""><?php echo e(__('backend/management.products.edit.price')); ?></label>
															<input type="number" class="form-control product-tiered-price" name="product_edit_tiered_price[]" value="<?php echo e($price->price); ?>" />
														</div>
													</div>
													<div class="col-2">
														<a class="delete-tiered cursor-pointer"><i class="la la-trash"></i></a>
													</div>
												</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<div class="tiered-item row">
												<div class="col-5">
													<div class="form-group">
														<label for=""><?php echo e(__('backend/management.products.edit.amount')); ?></label>
														<input type="text" class="form-control product-tiered-amount" name="product_edit_tiered_amount[]" />
													</div>
												</div>
												<div class="col-5">
													<div class="form-group">
														<label for=""><?php echo e(__('backend/management.products.edit.price')); ?></label>
														<input type="number" class="form-control product-tiered-price" name="product_edit_tiered_price[]" />
													</div>
												</div>
												<div class="col-2">
													<a class="delete-tiered cursor-pointer"><i class="la la-trash"></i></a>
												</div>
											</div>
											<?php endif; ?>
										</div>
										<div class="col-3">
											<button class="btn btn-wide btn-bold btn-primary" id="add_tiered_btn" type="button" style="margin-top:22px">Add</button>
										</div>
									</div>
								</div>
								<!-- / added by Khamid -->

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
			$('.product_edit_variant_div').hide();
			if($(this).attr('data-content-visible') == 'true' && $(this).is(':checked')) {
				$('.product_edit_content_div').show();
			} else {
				$('.product_edit_content_div').hide();
			}
		});

		$('input[data-weight-visible]').change(function() {
			$('.product_edit_variant_div').hide();
			if($(this).attr('data-weight-visible') == 'true' && $(this).is(':checked')) {
				$('.product_edit_weight_div').show();
			} else {
				$('.product_edit_weight_div').hide();
			}
		});

		// added by Khamid
		$('input[name="product_edit_stock_management"]').change(function() {
			
			if($(this).val() == "variants"){
				$('.product_edit_weight_div').hide();
				$('.product_edit_content_div').hide();
				$('.product_edit_tiered_div').hide();
				$('.product_edit_variant_div').show();

				// set base product price as 0 and make it disabled
				$("#product_edit_price_in_cent").val(0).attr("disabled", true);
				$("#product_edit_old_price_in_cent").val(0).attr("disabled", true);
			} else if($(this).val() == "tiered") {
				$('.product_edit_weight_div').hide();
				$('.product_edit_content_div').hide();
				$('.product_edit_variant_div').hide();
				$('.product_edit_tiered_div').show();

				// set base product price as 0 and make it disabled
				$("#product_edit_price_in_cent").val(0).attr("disabled", true);
				$("#product_edit_old_price_in_cent").val(0).attr("disabled", true);
			} else {
				$("#product_edit_price_in_cent").removeAttr("disabled");
				$("#product_edit_old_price_in_cent").removeAttr("disabled");
			}
		})

		$("#add_variant_btn").on("click", function(){
			let html = $(".variant-item:first").clone(true).appendTo('.variant-wrapper');
			$(".variant-item:last").find("input").map(function(){
				$(this).val("");
			});
		})

		$("#add_tiered_btn").on("click", function(){
			let html = $(".tiered-item:first").clone(true).appendTo('.tiered-wrapper');
			$(".tiered-item:last").find("input").map(function(){
				$(this).val("");
			});
		})

		$(".delete-variant").on("click", function(){
			if($(".variant-item").length == 1){
				return;
			}
			$(this).parents(".variant-item").remove();
		})

		$(".delete-tiered").on("click", function(){
			if($(".tiered-item").length == 1){
				return;
			}
			$(this).parents(".tiered-item").remove();
		})

		$(".product-img").on("click", function(){
			$(".product-img").removeClass("selected");
			$(".product-img-new").removeClass("selected");
			$(this).addClass("selected");
			$("#main_img_name").val($(this).attr("data-img_path"));
			$("#main_img_index").val(-1);
		})

		$(".delete-img-btn").on("click", function(){
			let deleted_img_ids = $("#deleted_img_ids").val();
			if(deleted_img_ids)
				deleted_img_ids += ',' + $(this).parents(".product-img-item").attr("data-img_id");
			else
				deleted_img_ids += $(this).parents(".product-img-item").attr("data-img_id");
			$("#deleted_img_ids").val(deleted_img_ids);
			
			$(this).parents(".product-img-item").remove();
			$("#product_img").removeAttr("disabled");
		})

		$("#product_img").on('change', function () {
			if(this.files.length == 0) {
				removeAllNewAddedPictures();
				return;
			}

			if(this.files.length + $('.product-img').length > 3){
				alert("You can only upload 3 files");
				$(this).val(''); 
				return;
			}

			displayPicture(this);
		});

		var displayPicture = function(input) {
			$(".product-img-new").remove();
			if (input.files) {
				var filesAmount = input.files.length;

				for (i = 0; i < filesAmount; i++) {
					if(i > 2)
						break;
					var reader = new FileReader();

					reader.onload = function(event) {
						$($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'product-img-new').appendTo(".product-imgs-preview");
						
						product_img_click_listener();
						select_first_img();
					}

					reader.readAsDataURL(input.files[i]);
				}
			}
			
		};

		var removeAllNewAddedPictures = function(input) {
			$(input).val('');
			$(".product-img-new").remove();
		}

		var product_img_click_listener = function(){
			$(".product-img-new").on("click", function(){
				$(".product-img").removeClass("selected");
				$(".product-img-new").removeClass("selected");
				$(this).addClass("selected");
				$("#main_img_name").val("");
				$("#main_img_index").val($(this).index() - 1);
			})
		}

		function select_first_img() {
			if(!$(".product-img").hasClass("selected"))
				$(".product-img-new:first").trigger("click");
		}
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/management/products/edit.blade.php ENDPATH**/ ?>