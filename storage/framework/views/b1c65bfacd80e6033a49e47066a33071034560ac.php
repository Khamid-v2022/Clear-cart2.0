<div>
    <div class="w-100 h-100 overlay d-none"></div>

    <!-- Navbar -->
    <div class="row d-flex flex-row align-items-center p-2 m-0 w-100" id="navbar">
        <div class="d-block d-sm-none">
            <i class="fas fa-arrow-left p-2 mr-2 text-white" style="font-size: 1.5rem; cursor: pointer;"></i>
        </div>
        <div id="profileImage">
            <?php echo e(ucfirst(substr(auth()->user()->name, 0, 1))); ?>

        </div>
        <div class="d-flex flex-column">
            <div class="text-black font-weight-bold userName" id="name">
                <?php echo e(ucfirst($appName)); ?>

            </div>
            <div class="text-black small userName" id="details">
                <span class="indicator online"></span>
                Open
            </div>
        </div>
        <div class="d-flex flex-row align-items-center ml-auto">
            <?php if(isset($userTicket->id)): ?>
            <!-- Button trigger modal -->
            

            
            <?php endif; ?>
        </div>
    </div>

    <!-- Messages -->
    <!-- wire:poll.10000ms -->
    <div class="d-flex flex-column message-box" id="messages" wire:poll.10000ms>
        <?php if(count($ticketMessagesList) > 0): ?>
        <?php $__currentLoopData = $ticketMessagesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $ticketMessages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mx-auto my-2 bg-primary text-white small py-1 px-2 rounded">
            <?php echo e($date); ?>

        </div>
        <?php $__currentLoopData = $ticketMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticketMessage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($ticketMessage->sender_id == auth()->id()): ?>
        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2">
                    <?php if($ticketMessage->type == "text"): ?>
                    <?php echo $ticketMessage->message; ?>

                    <?php elseif($ticketMessage->type == "image"): ?>
                    <img src="<?php echo e(asset('storage/chat_files/'.$ticketMessage->message)); ?>" class="rounded  img-thumbnail"
                        width="300px" height="300px" />
                    <?php endif; ?>
                </div>
                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white" style="width:75px;">
                    <?php echo e(getTimeDiff($ticketMessage->created_at)); ?>

                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2 text-black">
                    <?php if($ticketMessage->type == "text"): ?>
                    <?php echo $ticketMessage->message; ?>

                    <?php elseif($ticketMessage->type == "image"): ?>
                    <img src="<?php echo e(asset('storage/chat_files/'.$ticketMessage->message)); ?>" class="rounded  img-thumbnail"
                        width="300px" height="300px" />
                    <?php endif; ?>
                </div>
                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-black" style="width:75px;">
                    <?php echo e(getTimeDiff($ticketMessage->created_at)); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2 text-black">No Message Found</div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if(isset($userTicket) && $userTicket->status == 'open'): ?>
    <form method="post">
        <?php echo csrf_field(); ?>
        <!-- Input -->
        <div class="justify-self-end align-items-center flex-row d-flex" id="input-area">
            <a href="#" class="moji">
                <i class="far fa-smile text-muted px-3" style="font-size:1.5rem;"></i>
            </a>
            <input wire:model='message' type="text" name="message" id="input" placeholder="Type a message"
                class="flex-grow-1 border-0 px-3 py-2 my-3 rounded shadow-sm" required />
            <button type="submit" wire:click.prevent='storeMessage()' class="send px-3">
                <i wire:click.prevent='storeMessage()' class="fas fa-paper-plane text-white text-muted"
                    style="cursor:pointer;"></i>
            </button>
        </div>
    </form>
    <?php endif; ?>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="chatFileUpload" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="upload-file" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <i class="fas fa-paperclip text-muted mr-2"></i>
                            Attach File
                        </h5>
                        <button wire:click='closeFileModal()' type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input wire:model="photo" type="file" id="formFile" />
                            <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <?php if($photo): ?>
                            <img src="<?php echo e($photo->temporaryUrl()); ?>" class="rounded mx-auto d-block img-thumbnail" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click='closeFileModal()' type="button" class="btn btn-secondary myBtn"
                            data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="saveImage()" class="btn btn-success myBtn">
                            <i class="fas fa-paper-plane text-white" style="cursor:pointer;"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('css'); ?>
    <style>
        .btn-sm-my {
            padding: 0.20rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .btn i {
            padding-right: 0px !important;
            vertical-align: middle;
            line-height: 0;
        }
    </style>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('js'); ?>
    <script>
        document.addEventListener('livewire:load', function () {
            livewire.on('chatModalOpen', () => {
                $('#chatFileUpload').find("form#upload-file")[0].reset();
                $('#chatFileUpload').modal('show');
            });

            livewire.on('chatModalClose', () => {
                $('#chatFileUpload').find("form#upload-file")[0].reset();
                $('#chatFileUpload').modal('hide');
            });

            Livewire.on('deleteTicketConfirm', (status)=> {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this user ticket !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result)=> {
                    if (result.isConfirmed) {
                        livewire.emit('deleteUserTicket');
                    }
                });
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
</div><?php /**PATH E:\workspace\web\clear-shop\resources\views/livewire/front-end/chat/chat-body.blade.php ENDPATH**/ ?>