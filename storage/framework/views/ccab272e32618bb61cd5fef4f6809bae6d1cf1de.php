<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/main.home')); ?></h3>
        </div>
        
        <?php if(count($articles)): ?>
            <div class="col-md-12">
                <div id="newsAccordion" class="accordion-with-icon">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mb-15" id="newsHeading-<?php echo e($loop->iteration); ?>">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#newsCollapse-<?php echo e($loop->iteration); ?>" aria-expanded="<?php if($loop->iteration == 1): ?> true <?php else: ?> false <?php endif; ?>" aria-controls="newsCollapse-<?php echo e($loop->iteration); ?>">
                                    <?php echo e(\App\Classes\LangHelper::translate(app()->getLocale(), 'article', 'title', 'title', $article)); ?>

                                </button>
                            </h5>
                        </div>

                        <div id="newsCollapse-<?php echo e($loop->iteration); ?>" class="collapse <?php if($loop->iteration == 1): ?> show <?php endif; ?>" aria-labelledby="newsHeading-<?php echo e($loop->iteration); ?>" data-parent="#newsAccordion">
                            <div class="card-body">
                            <?php echo \App\Classes\LangHelper::translate(app()->getLocale(), 'article', 'content', 'body', $article, true); ?>

                            </div>
                        </div>

                        <?php if(strlen($article->created_at) > 0): ?>
                        <div class="card-footer">
                            <?php if(App\Models\User::find($article->user_id) != null): ?>
                                <span class="small-text">
                                    <ion-icon name="time"></ion-icon>

                                    <?php echo e(__('frontend/main.written_by', [
                                        'name' => App\Models\User::find($article->user_id)->username,
                                        'date' => $article->created_at->format('d.m.Y'),
                                        'time' => $article->created_at->format('H:i')
                                    ])); ?>

                                </span>
                            <?php else: ?>
                            <span class="small-text">
                                <ion-icon name="time"></ion-icon>
                                
                                <?php echo e(__('frontend/main.written_info', [
                                    'date' => $article->created_at->format('d.m.Y'),
                                    'time' => $article->created_at->format('H:i')
                                ])); ?>

                            </span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/main.no_articles_exists')); ?>

                </div>
            </div>        
        <?php endif; ?>
    </div>

    <?php if(count($articles)): ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php echo preg_replace('/' . $articles->currentPage() . '\?page=/', '', $articles->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/index.blade.php ENDPATH**/ ?>