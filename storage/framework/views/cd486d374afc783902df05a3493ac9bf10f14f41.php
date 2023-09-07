<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.tickets.ticket_create')); ?></h3>

            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/user.tickets.ticket_create')); ?></div>
                <div class="card-body">
					
						<?php if(\Session::has('errorMessageTicketForm')): ?>
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="<?php echo e(__('frontend/main.close')); ?>">
												<span aria-hidden="true">×</span>
											</button>

											<?php echo \Session::get('errorMessageTicketForm'); ?>

										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php if(\Session::has('successMessageTicketForm')): ?>
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="<?php echo e(__('frontend/main.close')); ?>">
												<span aria-hidden="true">×</span>
											</button>

											<?php echo \Session::get('successMessageTicketForm'); ?>

										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						
						<form method="POST" action="<?php echo e(route('ticket-create')); ?>">
							<?php echo csrf_field(); ?>

							<div class="form-group">
								<label for="subject"><?php echo e(__('frontend/user.tickets.subject')); ?></label>
								<input class="form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('subject')); ?>" name="subject" id="subject" required autofocus />

								<?php if($errors->has('subject')): ?>
									<span class="invalid-feedback" role="alert">
										<strong><?php echo e($errors->first('subject')); ?></strong>
									</span>
								<?php endif; ?>
							</div>

							<div class="form-group">
								<label for="ticket_category"><?php echo e(__('frontend/user.tickets.category')); ?></label>
								<select class="form-control<?php echo e($errors->has('ticket_category') ? ' is-invalid' : ''); ?>" name="ticket_category" id="ticket_category">
									<option value="0"><?php echo e(__('frontend/main.please_choose')); ?></option>
									<?php $__currentLoopData = \App\Models\UserTicketCategory::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userTicketCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($userTicketCategory->id); ?>" <?php if(old('ticket_category') == $userTicketCategory->id): ?> selected <?php endif; ?>><?php echo e(\App\Classes\LangHelper::getValue(app()->getLocale(), 'ticket-category', null, $userTicketCategory->id) ?? $userTicketCategory->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>

								<?php if($errors->has('ticket_category')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('ticket_category')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>

							<div class="form-group">
								<label for="message"><?php echo e(__('frontend/user.tickets.message')); ?></label>
								<textarea class="form-control<?php echo e($errors->has('message') ? ' is-invalid' : ''); ?>" name="message" id="message" rows="3" required><?php echo e(old('message')); ?></textarea>

								<?php if($errors->has('message')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>

							<div class="form-group">
								<label for="captcha"><?php echo e(__('frontend/main.captcha')); ?></label>
								<div class="captcha-img">
									<?php echo captcha_img('math'); ?>

								</div>
								<input type="text" class="form-control<?php echo e($errors->has('captcha') ? ' is-invalid' : ''); ?>" name="captcha" id="captcha" required />

								<?php if($errors->has('captcha')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('captcha')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>

							<div class="text-left">
								<input type="submit" value="<?php echo e(__('frontend/user.tickets.create_button')); ?>" class="btn btn-primary" />
							</div>
						</form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/frontend/userpanel/tickets/create.blade.php ENDPATH**/ ?>