<div>
    <!-- Navbar -->
    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
        <div id="profileImage">
            <?php echo e(ucfirst(substr(auth()->user()->name, 0, 1))); ?>

        </div>
        <div class="text-black font-weight-bold userName" id="username">
            <?php echo e(ucfirst(auth()->user()->username)); ?>

        </div>
        <div class="nav-item dropdown ml-auto">
            <button wire:click='newTicket()' class="btn btn-sm bth-primary newChatButton" type="button">
                New Ticket
            </button>
        </div>
    </div>

    

    <div class="row" id="chat-list" wire:poll.10000ms>
        <?php if((isset($ticketFirstList) && $ticketFirstList->count() > 0) || isset($ticketSecondList) &&
        $ticketSecondList->count() > 0): ?>

        <?php if(isset($ticketFirstList) && $ticketFirstList->count() > 0): ?>
        <?php $__currentLoopData = $ticketFirstList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div wire:click="updateBody(<?php echo e($ticket->id); ?>)"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom <?php if($userTicketId == $ticket->id): ?> chatActive <?php endif; ?>">
            <div class="w-50">
                <div class="name">Ticket Id # <?php echo e($ticket->id); ?> </div>
                <div class="small last-message">
                    Status :
                    <?php if($ticket->status == 'open'): ?>
                    <span class="ticketStatus text-success">Open</span>
                    <?php else: ?>
                    <span class="ticketStatus text-black">Closed</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex-grow-1 text-right">
                <div class="small time">
                    <?php echo e(getTimeDiff($ticket->updated_at)); ?>

                </div>
                <?php if(isset($ticketUnreadCount[$ticket->id]) && $ticketUnreadCount[$ticket->id] > 0): ?>
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    <?php echo e($ticketUnreadCount[$ticket->id]); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(isset($ticketSecondList) && $ticketSecondList->count() > 0): ?>
        <?php $__currentLoopData = $ticketSecondList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div wire:click="updateBody(<?php echo e($ticket->id); ?>)"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom <?php if($userTicketId == $ticket->id): ?> chatActive <?php endif; ?>">
            <div class="w-50">
                <div class="name">Ticket Id # <?php echo e($ticket->id); ?> </div>
                <div class="small last-message">
                    Status :
                    <?php if($ticket->status == 'open'): ?>
                    <span class="ticketStatus text-success">Open</span>
                    <?php else: ?>
                    <span class="ticketStatus text-black">Closed</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex-grow-1 text-right">
                <div class="small time">
                    <?php echo e(getTimeDiff($ticket->updated_at)); ?>

                </div>
                <?php if(isset($ticketUnreadCount[$ticket->id]) && $ticketUnreadCount[$ticket->id] > 0): ?>
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    <?php echo e($ticketUnreadCount[$ticket->id]); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php else: ?>
        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
            <div class="name">No Ticket Found</div>
        </div>
        <?php endif; ?>
    </div>

    <?php $__env->startPush('js'); ?>
    <script>
        document.addEventListener('livewire:load', function () {
            livewire.on('userTicketConfirm', () => {
                Swal.fire({
                    title: 'New User Ticket',
                    input: 'text',
                    inputPlaceholder: 'Type your message here...',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Add it!',
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        livewire.emit('storeUserTicket', result.value);
                    }
                });
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
</div><?php /**PATH E:\workspace\web\clear-shop\resources\views/livewire/front-end/chat/chat-ticket-list.blade.php ENDPATH**/ ?>