<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/main.faq')); ?></h3>
        </div>
    </div>
</div>


<div id="faqAccordion" class="mb-15 accordion-with-icon">
    <div class="container">
        <div class="row justify-content-center">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 mb-15">
                <div class="card">
                    <div class="card-header" id="faqHeading-<?php echo e($loop->iteration); ?>">
                        <h5 class="mb-0">
                            <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#faqCollapse-<?php echo e($loop->iteration); ?>" aria-expanded="<?php if($loop->iteration == 1): ?> true <?php else: ?> false <?php endif; ?>" aria-controls="faqCollapse-<?php echo e($loop->iteration); ?>">
                                <strong class=""><?php echo e($loop->iteration); ?>.</strong> 
                                <?php echo e(\App\Classes\LangHelper::translate(app()->getLocale(), 'faq', 'question', 'question', $faq)); ?>

                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse-<?php echo e($loop->iteration); ?>" class="collapse <?php if($loop->iteration == 1): ?> show <?php endif; ?>" aria-labelledby="faqHeading-<?php echo e($loop->iteration); ?>" data-parent="#faqAccordion">
                        <div class="card-body">
                            <?php echo \App\Classes\LangHelper::translate(app()->getLocale(), 'faq', 'answer', 'answer', $faq, true); ?>

                            
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
            
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/faq/faq.blade.php ENDPATH**/ ?>