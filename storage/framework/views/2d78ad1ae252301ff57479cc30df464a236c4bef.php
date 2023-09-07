<?php $__env->startSection('content'); ?>
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/management.products.title')); ?></h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="<?php echo e(route('backend-management-product-add')); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px"><?php echo e(__('backend/main.add')); ?></a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														<?php if(count($products)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th><?php echo e(__('backend/management.products.id')); ?></th>
																	<th><?php echo e(__('backend/management.products.name')); ?></th>
																	<th><?php echo e(__('backend/management.products.category')); ?></th>
																	<th><?php echo e(__('backend/management.products.price')); ?></th>
																	<th><?php echo e(__('backend/management.products.stock_status')); ?></th>
																	<th><?php echo e(__('backend/management.products.sells')); ?></th>
																	<th><?php echo e(__('backend/management.products.actions')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<th scope="row"><?php echo e($product->id); ?></th>
																	<td><?php echo e($product->name); ?></td>
																	<td>
																		<?php if($product->getCategory()->slug == 'uncategorized'): ?>
																		<?php echo e($product->getCategory()->name); ?>

																		<?php else: ?>
																		<a href="<?php echo e(route('backend-management-product-category-edit', $product->getCategory()->id)); ?>"><?php echo e($product->getCategory()->name); ?></a>
																		<?php endif; ?>
																	</td>
																	<td><?php echo e($product->getFormattedPrice()); ?></td>
																	<td>
																		<?php if($product->isUnlimited()): ?>
																			<?php echo e(__('backend/management.products.unlimited')); ?>

																		<?php elseif($product->asWeight()): ?>
																			<?php echo e(__('backend/management.products.weight_available', [
																				'weight' => $product->getWeightAvailable(),
																				'char' => $product->getWeightChar()
																			])); ?>

																		<?php else: ?>
																			<?php if($product->inStock()): ?>
																				<?php echo e($product->getStock()); ?>

																			<?php else: ?>
																				<?php echo e(__('backend/management.products.sold_out')); ?>

																			<?php endif; ?>
																		<?php endif; ?>
																	</td>
																	<td>
																		<?php echo e($product->getSells()); ?><?php if($product->asWeight()): ?><?php echo e($product->getWeightChar()); ?><?php endif; ?>
																	</td>
																	<td style="font-size: 20px;">
																		<?php if(!$product->isUnlimited() && !$product->asWeight()): ?>
																		<a href="<?php echo e(route('backend-management-product-database', $product->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/main.tooltips.database')); ?>"><i class="la la-database"></i></a>
																		<?php endif; ?>
																		<a href="<?php echo e(route('backend-management-product-edit', $product->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/main.tooltips.edit')); ?>"><i class="la la-edit"></i></a>
																		<a href="<?php echo e(route('backend-management-product-delete', $product->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('backend/main.tooltips.delete')); ?>"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>
														<?php else: ?>
														<i><?php echo e(__('backend/main.no_entries')); ?></i>
														<?php endif; ?>

														<?php echo preg_replace('/' . $products->currentPage() . '\?page=/', '', $products->links()); ?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/management/products/list.blade.php ENDPATH**/ ?>