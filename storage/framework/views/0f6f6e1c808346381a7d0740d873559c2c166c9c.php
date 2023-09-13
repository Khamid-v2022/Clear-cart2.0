

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/main.home')); ?></h3>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <h4 class="text-white"><?php echo e(__('frontend/main.top_seller_title')); ?></h4>
                <div class="row">
                    <?php $__currentLoopData = App\Models\Product::orderByDesc('sells')->limit(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bestsellerProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-sm-6 mt-3">
                        <a href="<?php echo e(route('product-page', $bestsellerProduct->id)); ?>" style="text-decoration: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="k-portlet__head-title"> <?php echo e($bestsellerProduct->name); ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php echo e($bestsellerProduct->getBaseItem()); ?>

                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
       
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/dashboard.blade.php ENDPATH**/ ?>