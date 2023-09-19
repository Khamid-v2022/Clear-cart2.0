<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/media.title')); ?></h3>
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
														<h3 class="kt-portlet__head-title"><?php echo e(__('backend/media.title')); ?></h3>
													</div>
												</div>
												
												<div class="kt-portlet__body">
													<?php if(count($errors) > 0): ?>
														<div class="alert alert-danger fade show" role="alert">
															<div class="alert-text">
																<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<li><?php echo e($error); ?></li>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</div>
															<div class="alert-close">
																<button type="button" class="close" data-dismiss="alert" aria-label="<?php echo e(__('frontend/main.close')); ?>">
																	<span aria-hidden="true"><i class="la la-close"></i></span>
																</button>
															</div>
														</div>
													<?php endif; ?>

													<form action="<?php echo e(route('backend-media-upload')); ?>" class="kt-form" method="POST" enctype="multipart/form-data">
														<?php echo csrf_field(); ?>

														<input type="file" name="media_file" /><br /><br />
														<button type="submit" class="btn btn-success"><?php echo e(__('backend/media.upload')); ?></button>
													</form>

													<hr />

													<?php if(count($medias)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/media.preview')); ?></th>
																	<th><?php echo e(__('backend/media.filename')); ?></th>
																	<th><?php echo e(__('backend/media.date')); ?></th>
																	<th><?php echo e(__('backend/media.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row">
																		<img src="<?php echo e(media($media->filename)); ?>" style="max-width: 40px;border:2px solid #ccc;border-radius:2px;padding:3px;" />
																	</th>
																	<td><?php echo e($media->filename); ?></td>
																	<td>
																		<?php echo e($media->created_at->format('d.m.Y H:i')); ?>

																	</td>
																	<td style="font-size: 20px;">
																		<a href="<?php echo e(media($media->filename)); ?>" target="_media"><i style="font-size: 18px;" class="fas fa-external-link-alt"></i></a>
																		<a href="<?php echo e(route('backend-media-delete', $media->id)); ?>"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>

														<?php echo preg_replace('/' . $medias->currentPage() . '\?page=/', '', $medias->links()); ?>

														<?php else: ?>
														<i><?php echo e(__('backend/main.no_entries')); ?></i>
														<?php endif; ?>
												</div>
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

<script>
   	CodeMirror.fromTextArea(document.getElementById('custom_css'), {
    	lineNumbers: true,
    	mode: 'css',
  	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/clearcart/resources/views/backend/media/media.blade.php ENDPATH**/ ?>