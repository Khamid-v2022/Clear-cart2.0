<div>
    <?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('whatsapp/style.css?t=')); ?><?= time() ?>">
    <?php $__env->stopPush(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 page-title">
                <!-- add button on right side -->
                <div class="float-left">
                    <h3 class="">
                        <?php echo e(__('frontend/user.tickets.list_tickets')); ?>

                    </h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo e(__('frontend/user.tickets.list_tickets')); ?>

                    </div>
                    <div class="card-body">
                        <div class="row h-100">
                            <!-- left part -->
                            <div class="col-12 col-sm-3 col-md-3 d-flex flex-column" id="chat-list-area"
                                style="position:relative;">
                                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('front-end.chat.chat-ticket-list',['userTicketId' => $userTicketId])->html();
} elseif ($_instance->childHasBeenRendered('l1514555311-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1514555311-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1514555311-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1514555311-0');
} else {
    $response = \Livewire\Livewire::mount('front-end.chat.chat-ticket-list',['userTicketId' => $userTicketId]);
    $html = $response->html();
    $_instance->logRenderedChild('l1514555311-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                            </div>

                            <!-- right part -->
                            <div class="d-none d-sm-flex flex-column col-12 col-sm-9 col-md-9 p-0 h-100"
                                id="message-area">
                                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('front-end.chat.chat-body',['userTicketId' => $userTicketId])->html();
} elseif ($_instance->childHasBeenRendered('l1514555311-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l1514555311-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1514555311-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1514555311-1');
} else {
    $response = \Livewire\Livewire::mount('front-end.chat.chat-body',['userTicketId' => $userTicketId]);
    $html = $response->html();
    $_instance->logRenderedChild('l1514555311-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\workspace\web\clear-shop\resources\views/livewire/front-end/chat/chat-dashbaord.blade.php ENDPATH**/ ?>