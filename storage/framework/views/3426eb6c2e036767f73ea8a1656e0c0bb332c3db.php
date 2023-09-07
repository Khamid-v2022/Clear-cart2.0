<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(count($products)): ?>
        <h3 class="page-title"><?php echo e(\App\Classes\LangHelper::getValue(app()->getLocale(), 'product-category', null, $productCategory->id) ?? $productCategory->name); ?></h3>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                <?php echo $__env->make('frontend/shop.product_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/shop.no_products_category_exists')); ?>

                </div>
            </div>   
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/products_category.blade.php ENDPATH**/ ?>