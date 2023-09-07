<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/main.shop')); ?></h3>
        </div>
    </div>
</div>

<div class="container">
    <?php if(count(\App\Models\Product::all())): ?>
        <div class="row">
        <?php if(count(App\Models\Product::getUncategorizedProducts())): ?>
            <!--<h5><?php echo e(__('frontend/shop.uncategorized')); ?></h5>
            <div class="row">-->
            <?php $__currentLoopData = App\Models\Product::getUncategorizedProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                <?php echo $__env->make('frontend/shop.product_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--</div>
        
            <hr />-->
        <?php endif; ?>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--<h5><?php echo e($category->name); ?></h5>
            <div class="row">-->
            <?php $__currentLoopData = $category->getProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                <?php echo $__env->make('frontend/shop.product_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--</div>-->

            <?php if(!$loop->last): ?>
            <!--<hr />--> 
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/shop.no_products_exists')); ?>

                </div>
            </div>   
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/shop/shop.blade.php ENDPATH**/ ?>