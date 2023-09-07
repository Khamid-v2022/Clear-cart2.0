<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.profile')); ?></h3>

            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/main.userpanel')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <p>
                        <?php echo __('frontend/user.panel.welcome_message', [ 'name' => e(Auth::user()->username) ]); ?>

                    </p>

                    <p>
                        <?php echo __('frontend/user.panel.member_since', [ 'date' => e(Auth::user()->created_at->format('d.m.Y')) ]); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/frontend/userpanel/home.blade.php ENDPATH**/ ?>