<?php $__env->startSection('content'); ?>
	<div class="k-content__head	k-grid__item">
		<div class="k-content__head-main">
			<h3 class="k-content__head-title">Mehrfach Bestellungen</h3>
		</div>
	</div>
	<div class="k-content__body	k-grid__item k-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
			<!-- <a href="<?php echo e(route('backend-orders')); ?>" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Einzelne Bestellungen</a> -->
			<div class="kt-portlet">
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<?php if(count($shoppings)): ?>

							<table class="table table-head-noborder">
								<thead>
									<tr>
										<th>ID</th>
										<th>Benutzer</th>
										<th>Bestellungen</th>
										<th>Abgearbeitet</th>
										<th>Aktionen</th>
									</tr>
								</thead>
								<tbody>
							<?php $__currentLoopData = $shoppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shopping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<th scope="row"><?php echo e($shopping->id); ?></th>
								<td><?php echo e($shopping->getUser()->name); ?></td>
								<td><?php echo e(count($shopping->getOrders())); ?></td>
								<td><?php echo e($shopping->isDone() ? 'Ja' : 'Nein'); ?></td>
								<td>
								<?php if(!$shopping->isDone()): ?> 
								<a href="<?php echo e(route('backend-shopping-done', $shopping->id)); ?>" data-toggle="tooltip" data-original-title="Als abgearbeitet markieren">Als abgearbeitet markieren</a>
								| <?php endif; ?>
								<a href="<?php echo e(route('backend-shopping-id', $shopping->id)); ?>" data-toggle="tooltip" data-original-title="Ansehen">Ansehen</a>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>

							<?php echo preg_replace('/' . $shoppings->currentPage() . '\?page=/', '', $shoppings->links()); ?>

							<?php else: ?>
							<i><?php echo e(__('backend/main.no_entries')); ?></i>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/orders/list2.blade.php ENDPATH**/ ?>