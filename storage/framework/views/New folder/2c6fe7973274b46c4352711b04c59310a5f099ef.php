<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="page-title"><?php echo e(__('frontend/user.register.title')); ?></h3>

            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/user.register.title')); ?></div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                      <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                             <div class="col-md-12">
                             <label for="username" class="text-md-right"><?php echo e(__('frontend/user.username')); ?></label>

                              <input id="username" type="text" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="jabber_id" class="text-md-right"><?php echo e(__('frontend/user.jabber_id')); ?></label>
                      <input id="jabber_id" type="email" class="form-control<?php echo e($errors->has('jabber_id') ? ' is-invalid' : ''); ?>" name="jabber_id" value="<?php echo e(old('jabber_id')); ?>" required>

                                <?php if($errors->has('jabber_id')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('jabber_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="password" class="text-md-right"><?php echo e(__('frontend/user.register.password')); ?></label>
                                   <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md-12">
                            <label for="password-confirm" class="text-md-right"><?php echo e(__('frontend/user.register.confirm_password')); ?></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                             <div class="col-md-12">
                             <label for="password" class="text-md-right"><?php echo e(__('frontend/main.captcha')); ?></label>
                               <div class="captcha-img">
                                    <?php echo captcha_img('math'); ?>

                                </div>
                                <input type="text" class="form-control <?php echo e($errors->has('captcha') ? ' is-invalid' : ''); ?>" name="captcha" id="captcha" required />
                            
                                <?php if($errors->has('captcha')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('captcha')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="newsletter_enabled" id="newsletter_enabled" <?php echo e(old('newsletter_enabled') ? 'checked' : App\Models\Setting::get('register.newsletter_enabled') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="newsletter_enabled">
                                        <?php echo e(__('frontend/user.register.newsletter_enabled')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('frontend/user.register.submit')); ?>

                                </button>
                                <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-secondary">
                                    <?php echo e(__('frontend/user.register.cancel')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                            </div>
                        </div>
               </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/frontend/auth/register.blade.php ENDPATH**/ ?>