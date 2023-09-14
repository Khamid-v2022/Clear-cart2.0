<?php $__env->startSection('content'); ?>
	<div class="k-content__head	k-grid__item">
		<div class="k-content__head-main">
			<h3 class="k-content__head-title"><?php echo e(__('backend/management.faqs.edit.title')); ?></h3>
			<div class="k-content__head-breadcrumbs">
				<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
				<span class="k-content__head-breadcrumb-separator"></span>
				<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
				<span class="k-content__head-breadcrumb-separator"></span>
				<a href="<?php echo e(route('backend-management-faqs')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.faqs.title')); ?></a>
			</div>
		</div>
	</div>
	<div class="k-content__body	k-grid__item k-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
			
				<?php echo e(App\Classes\LangHelper::getLangSelector('lang-edit-faq', $faq->id, $lang ?? null)); ?>

				
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title"><?php echo e(__('backend/management.faqs.edit.title')); ?></h3>
						</div>
					</div>
					<form method="post" class="kt-form" action="<?php echo e(route('backend-management-faq-edit-form')); ?>">
						<?php echo csrf_field(); ?>

						<?php if($lang != null): ?>
							<input type="hidden" name="translation_lng" value="<?php echo e(strtolower($lang)); ?>" />
						<?php endif; ?>
						
						<input type="hidden" value="<?php echo e($faq->id); ?>" name="faq_edit_id" />

						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="form-group">
									<label for="faq_edit_question"><?php echo e(__('backend/management.faqs.question')); ?></label>
									<input type="text" class="form-control <?php if($errors->has('faq_edit_question')): ?> is-invalid <?php endif; ?>" id="faq_edit_question" name="faq_edit_question" placeholder="<?php echo e(__('backend/management.faqs.question')); ?>" value="<?php echo e(\App\Classes\LangHelper::getValue($lang, 'faq', 'question', $faq->id) ?? $faq->question); ?>" />

									<?php if($errors->has('faq_edit_question')): ?>
										<span class="invalid-feedback" style="display:block" role="alert">
											<strong><?php echo e($errors->first('faq_edit_question')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
								
								<!-- <?php if($lang == null): ?>
								<div class="form-group">
									<label for="faq_edit_category"><?php echo e(__('backend/management.faqs.category')); ?></label>
									<select name="faq_edit_category" id="faq_edit_category" class="form-control <?php if($errors->has('faq_edit_category')): ?> is-invalid <?php endif; ?>">
										<option value="0"><?php echo e(__('backend/main.please_choose')); ?></option>
										<?php $__currentLoopData = App\Models\FAQCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faqCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($faqCategory->id); ?>" <?php if($faq->getCategory()->id == $faqCategory->id): ?> selected <?php endif; ?>><?php echo e($faqCategory->name); ?></option>	
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>

									<?php if($errors->has('faq_edit_category')): ?>
										<span class="invalid-feedback" style="display:block;" role="alert">
											<strong><?php echo e($errors->first('faq_edit_category')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
								<?php endif; ?> -->

								<div class="form-group">
									<label for="faq_edit_answer"><?php echo e(__('backend/management.faqs.answer')); ?></label>
									<textarea class="text-editor form-control <?php if($errors->has('faq_edit_answer')): ?> is-invalid <?php endif; ?>" id="faq_edit_answer" name="faq_edit_answer" placeholder="<?php echo e(__('backend/management.faqs.answer')); ?>"><?php echo e(\App\Classes\LangHelper::getValue($lang, 'faq', 'answer', $faq->id) ?? (strlen($faq->answer) > 0 ? decrypt($faq->answer) : '')); ?></textarea>

									<?php if($errors->has('faq_edit_answer')): ?>
										<span class="invalid-feedback" style="display:block" role="alert">
											<strong><?php echo e($errors->first('faq_edit_answer')); ?></strong>
										</span>
									<?php endif; ?>
								</div>

								<?php if($lang == null): ?>
								<div class="form-group">
									<label for="faq_edit_ordering">Reihenfolge</label>
									<input type="number" class="form-control <?php if($errors->has('faq_edit_ordering')): ?> is-invalid <?php endif; ?>" id="faq_edit_ordering" name="faq_edit_ordering" placeholder="" value="<?php echo e($faq->ordering); ?>" />

									<?php if($errors->has('faq_edit_ordering')): ?>
										<span class="invalid-feedback" style="display:block" role="alert">
											<strong><?php echo e($errors->first('faq_edit_ordering')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/management.faqs.edit.submit_button')); ?></button>
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
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/management/faqs/edit.blade.php ENDPATH**/ ?>