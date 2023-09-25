<div>
    <?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('whatsapp/style.css?t=')); ?><?= time() ?>">
    <?php $__env->stopPush(); ?>

    <div class="k-content__head	k-grid__item">
        <div class="k-content__head-main">
            <h3 class="k-content__head-title">
                <?php echo e(__('backend/management.tickets.title')); ?>

            </h3>
            <div class="k-content__head-breadcrumbs">
                <a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
                <span class="k-content__head-breadcrumb-separator"></span>
                <a href="javascript:;" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/management.title')); ?></a>
            </div>
        </div>
    </div>
    <div class="k-content__body	k-grid__item k-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="row">
                                <!-- left part -->
                                <div class="col-12 col-sm-3 col-md-3 d-flex flex-column" id="chat-list-area"
                                    style="position:relative;">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('back-end.chat.chat-ticket-list',['userTicketId' => $userTicketId])->html();
} elseif ($_instance->childHasBeenRendered('l3769508618-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3769508618-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3769508618-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3769508618-0');
} else {
    $response = \Livewire\Livewire::mount('back-end.chat.chat-ticket-list',['userTicketId' => $userTicketId]);
    $html = $response->html();
    $_instance->logRenderedChild('l3769508618-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>

                                <!-- right part -->
                                <div class="d-none d-sm-flex flex-column col-12 col-sm-9 col-md-9 p-0 h-100"
                                    id="message-area">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('back-end.chat.chat-body',['userTicketId' => $userTicketId])->html();
} elseif ($_instance->childHasBeenRendered('l3769508618-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3769508618-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3769508618-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3769508618-1');
} else {
    $response = \Livewire\Livewire::mount('back-end.chat.chat-body',['userTicketId' => $userTicketId]);
    $html = $response->html();
    $_instance->logRenderedChild('l3769508618-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
    </div>
</div><?php /**PATH E:\workspace\web\clear-shop\resources\views/livewire/back-end/chat/chat-dashbaord.blade.php ENDPATH**/ ?>