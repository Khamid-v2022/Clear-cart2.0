<div>
    <!-- Navbar -->
    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
        <div id="profileImage">
            <?php echo e(ucfirst(substr(auth()->user()->name, 0, 1))); ?>

        </div>
        <div class="text-black font-weight-bold userName" id="username">
            <?php echo e(ucfirst(auth()->user()->username)); ?>

        </div>
    </div>

    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
        <!-- front side search icon input text box -->
        <div class="input-group newDesign">
            <input wire:model='search_ticket' type="text" class="form-control" placeholder="Search By Ticket #"
                aria-label="Search" aria-describedby="basic-addon1" id="search-box" />
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row" id="chat-list" wire:poll.10000ms>
        <?php if((isset($ticketFirstList) && $ticketFirstList->count() > 0) || isset($ticketSecondList) &&
        $ticketSecondList->count() > 0): ?>
        <!-- first list -->
        <?php if(isset($ticketFirstList) && $ticketFirstList->count() > 0): ?>
        <?php $__currentLoopData = $ticketFirstList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div wire:click="updateBody(<?php echo e($ticket->ticket_id); ?>)"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom <?php if($userTicketId != '' && $userTicketId == $ticket->ticket_id): ?> chatActive <?php endif; ?>">
            <div class="w-50">
                <div class="name">Ticket Id # <?php echo e($ticket->ticket_id); ?> </div>
                <div class="small last-message">
                    <?php echo e(ucfirst($ticket->user_name)); ?> |
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
                <?php if(isset($ticketUnreadCount[$ticket->ticket_id]) && $ticketUnreadCount[$ticket->ticket_id] > 0): ?>
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    <?php echo e($ticketUnreadCount[$ticket->ticket_id]); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!-- Second List -->
        <?php if(isset($ticketSecondList) && $ticketSecondList->count() > 0): ?>
        <?php $__currentLoopData = $ticketSecondList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div wire:click="updateBody(<?php echo e($ticket->ticket_id); ?>)"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom <?php if($userTicketId != '' && $userTicketId == $ticket->ticket_id): ?> chatActive <?php endif; ?>">
            <div class="w-50">
                <div class="name">Ticket Id # <?php echo e($ticket->ticket_id); ?> </div>
                <div class="small last-message">
                    <?php echo e(ucfirst($ticket->user_name)); ?> |
                    <?php if($ticket->status == 'open'): ?>
                    <span class="ticketStatus text-success">Open</span>
                    <?php else: ?>
                    <span class="ticketStatus text-black">Closed</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex-grow-1 text-right">
                <div class="small time">
                    <?php echo e(getTimeDiff($ticket->ticket_updated_at)); ?>

                </div>
                <?php if(isset($ticketUnreadCount[$ticket->ticket_id]) && $ticketUnreadCount[$ticket->ticket_id] > 0): ?>
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    <?php echo e($ticketUnreadCount[$ticket->ticket_id]); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php else: ?>
        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
            <div class="w-50">
                <div class="name">No Ticket Found</div>
            </div>
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
</div><?php /**PATH E:\workspace\web\clear-shop\resources\views/livewire/back-end/chat/chat-ticket-list.blade.php ENDPATH**/ ?>