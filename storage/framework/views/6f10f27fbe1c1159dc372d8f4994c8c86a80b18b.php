<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"><?php echo e(__('frontend/user.transactions')); ?></h3>

            <?php if(count($user_transactions)): ?>
            <div class="card">
                <div class="card-header"><?php echo e(__('frontend/user.transactions_history')); ?></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-transactions table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.id')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/v5.payment_method')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.wallet')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.txid')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.status')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.amount')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.date')); ?></th>
                                    <th scope="col"><?php echo e(__('frontend/user.transactions_page.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php if($transaction->isPending()): ?> bg-light <?php elseif($transaction->isWaiting()): ?> bg-light-2 <?php endif; ?>">
                                    <th scope="row">#<?php echo e($transaction->id); ?></th>
                                    <td><?php echo e(strtoupper($transaction->payment_method)); ?></td>
                                    <td><?php echo e(strlen($transaction->wallet) ? decrypt($transaction->wallet) : ''); ?></td>
                                    <td style="max-width:200px;">
                                        <?php if(strlen($transaction->txids) > 0): ?>
                                            <?php $__currentLoopData = explode(',', decrypt($transaction->txids)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <a href="https://blockchain.info/tx/<?php echo e($txid); ?>" target="_blockchain_<?php echo e($loop->iteration); ?>">
                                                    <?php echo e($txid); ?>

                                                    <ion-icon name="open"></ion-icon>
                                                </a>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($transaction->isPaid()): ?>
                                            <span class="label label-success">
                                                <?php echo e(__('frontend/user.transactions_page.confirmed')); ?>

                                            </span>
                                        <?php elseif($transaction->isPending()): ?>
                                            <span class="label label-warning">
                                                <?php echo e(__('frontend/user.transactions_page.confirmations', [
                                                    'confirms' => $transaction->confirmations,
                                                    'confirms_needed' => App\Models\Setting::get('shop.btc_confirms_needed')
                                                ])); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="label label-secondary">
                                                <?php echo e(__('frontend/user.transactions_page.waiting')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($transaction->getFormattedAmount()); ?>

                                    </td>
                                    <td>
                                        <?php echo e($transaction->getDate()); ?>

                                    </td>
                                    <td>
                                        <?php if(!$transaction->isWaiting() && strlen($transaction->txid) > 0): ?>
                                        <a href="https://blockchain.info/tx/<?php echo e(decrypt($transaction->txid)); ?>" target="_blockchain_<?php echo e($transaction->id); ?>">
                                            Blockchain
                                            <ion-icon name="open"></ion-icon>
                                        </a>
                                        <?php elseif($transaction->isWaiting()): ?>
                                        <form method="POST" action="<?php echo e(route('deposit-btc-post', $transaction->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <button type="submit" class="btn btn-link" style="margin: 0;padding: 0;"><?php echo e(__('frontend/user.i_paid_button')); ?></button>
                                        </form>
                                        <?php elseif($transaction->isPending()): ?>
                                        <form method="POST" action="<?php echo e(route('deposit-btc-post', $transaction->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <button type="submit" class="btn btn-link" style="margin: 0;padding: 0;"><?php echo e(__('frontend/user.check_again')); ?></button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo preg_replace('/' . $user_transactions->currentPage() . '\?page=/', '', $user_transactions->links()); ?>

                </div>
            </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <?php echo e(__('frontend/user.transactions_page.no_transactions_exists')); ?>

                </div>  
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/frontend/userpanel/transactions.blade.php ENDPATH**/ ?>