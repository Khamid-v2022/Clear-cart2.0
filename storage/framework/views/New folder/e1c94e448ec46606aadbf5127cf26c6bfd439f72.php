<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title"><?php echo e(__('frontend/shop.product_details')); ?></h3>

            <?php echo $__env->make('frontend/shop.product_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <a href="<?php echo e(route('product-category', [$product->getCategory()->slug])); ?>" class="btn btn-outline-secondary d-lg-none d-md-inline-block"><?php echo e(__('frontend/shop.to_shop')); ?></a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u289188536/domains/clear-red.shop/public_html/resources/views/frontend/shop/product.blade.php ENDPATH**/ ?>