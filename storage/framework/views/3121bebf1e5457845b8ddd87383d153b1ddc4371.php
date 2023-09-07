<?php $__env->startSection('content'); ?>
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.products.categories.title')); ?></h3>
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
											<a href="<?php echo e(route('backend-management-product-category-add')); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px"><?php echo e(__('backend/main.add')); ?></a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														<?php if(count($productsCategories)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/management.products.categories.id')); ?></th>
																	<th><?php echo e(__('backend/management.products.categories.name')); ?></th>
																	<th><?php echo e(__('backend/management.products.categories.slug')); ?></th>
																	<th><?php echo e(__('backend/management.products.categories.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $productsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row"><?php echo e($productCategory->id); ?></th>
																	<td><?php echo e($productCategory->name); ?></td>
																	<td><?php echo e($productCategory->slug); ?></td>
																	<td style="font-size: 20px;">
																		<a href="<?php echo e(route('backend-management-product-category-edit', $productCategory->id)); ?>"><i class="la la-edit"></i></a>
																		<a href="<?php echo e(route('backend-management-product-category-delete', $productCategory->id)); ?>"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>
														<?php else: ?>
														<i><?php echo e(__('backend/main.no_entries')); ?></i>
														<?php endif; ?>

														<?php echo preg_replace('/' . $productsCategories->currentPage() . '\?page=/', '', $productsCategories->links()); ?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/backend/management/products/categories/list.blade.php ENDPATH**/ ?>