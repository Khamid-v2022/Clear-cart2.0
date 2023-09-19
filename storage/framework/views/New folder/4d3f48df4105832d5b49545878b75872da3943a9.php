<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.tickets.list_tickets')); ?></h3>

            <?php if(count($user_tickets)): ?>
            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/user.tickets.list_tickets')); ?></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-tickets table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.id')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.subject')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.category')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.status')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.date')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.tickets.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php if($ticket->isClosed()): ?> bg-light <?php elseif($ticket->isReplied()): ?> bg-light-2 <?php endif; ?>">
                                    <th scope="row">#<?php echo e($ticket->id); ?></th>
									
                                    <td>
										<a href="<?php echo e(route('ticket-id', $ticket->id)); ?>"><?php echo e(substr($ticket->subject, 0, 255)); ?></a>
									</td>
									
                                    <td><?php echo e($ticket->getCategory()->name); ?></td>
                                    
                                    <td>
                                        <?php if($ticket->isClosed()): ?>
										    <?php echo e(__('frontend/user.tickets.status_data.closed')); ?>

										<?php else: ?>
											<?php if(!$ticket->isReplied()): ?>
                                                <?php echo e(__('frontend/user.tickets.status_data.open')); ?>

											<?php else: ?>
                                                <?php echo e(__('frontend/user.tickets.status_data.replied')); ?>

											<?php endif; ?>
										<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($ticket->getDate()); ?>

                                    </td>
                                    <td>
										<a href="<?php echo e(route('ticket-id', $ticket->id)); ?>"><?php echo e(__('frontend/user.tickets.view')); ?></a>
										<span class="span-divider">|</span>
										<a href="<?php echo e(route('ticket-delete', $ticket->id)); ?>"><?php echo e(__('frontend/user.tickets.delete')); ?></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo preg_replace('/' . $user_tickets->currentPage() . '\?page=/', '', $user_tickets->links()); ?>

                </div>
            </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/user.tickets.no_tickets_exists')); ?>

                </div>  
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/userpanel/tickets/list_tickets.blade.php ENDPATH**/ ?>