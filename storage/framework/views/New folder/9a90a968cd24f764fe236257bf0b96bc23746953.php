<?php $__env->startSection('content'); ?>
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/orders.show.title', ['id' => $order->id])); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="<?php echo e(route('backend-orders')); ?>" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/orders.title')); ?></a>
										</div>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/orders.notes')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<div class="user-order-note">
														<?php echo e(strlen($note->note) > 0 ? decrypt($note->note) : ''); ?>

														<span><?php echo e($note->getDateTime()); ?></span>
													</div>
													
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

													<hr />
													
													<form method="POST" action="<?php echo e(route('backend-orders-add-note-form', ['id' => $order->id])); ?>" style="width: 100%;">
														<?php echo csrf_field(); ?>
														
														<div class="form-group" style="width: 100%;">
															<label for="order_note"><?php echo e(__('backend/orders.note_input')); ?></label>
															<textarea style="width: 100%;" class="form-control <?php if($errors->has('order_note')): ?> is-invalid <?php endif; ?>" name="order_note" id="order_note" placeholder=""><?php echo e(old('order_note')); ?></textarea>

															<?php if($errors->has('order_note')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('order_note')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="<?php echo e(__('backend/orders.add_note')); ?>" />
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/orders/show.blade.php ENDPATH**/ ?>