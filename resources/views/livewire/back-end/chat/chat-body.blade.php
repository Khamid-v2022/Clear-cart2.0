<div>
    @push('css')
    <style>
        .btn-sm-my {
            padding: 0.35rem 0.35rem;
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
    @endpush

    <div class="w-100 h-100 overlay d-none"></div>

    <!-- Navbar -->
    <div class="row d-flex flex-row align-items-center p-2 m-0 w-100" id="navbar">
        <div class="d-block d-sm-none">
            <i class="fas fa-arrow-left p-2 mr-2 text-white" style="font-size: 1.5rem; cursor: pointer;"></i>
        </div>
        <div id="profileImage">
            {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="d-flex flex-column">
            <div class="text-black font-weight-bold userName" id="name">
                @if(isset($userTicket->ticketUser->username))
                {{ ucfirst($userTicket->ticketUser->username) }}
                @else
                {{ ucfirst($appName) }}
                @endif
            </div>
            <div class="text-black small userName" id="details">
                <span class="indicator online"></span>
                Online
            </div>
        </div>
        <div class="d-flex flex-row align-items-center ml-auto">
            @if(isset($userTicket->id))
            <!-- Button trigger modal -->
            {{-- <a data-toggle="modal" data-target="#chatFileUpload">
                <i class=" fas fa-paperclip mx-3 text-muted d-none d-md-block"></i>
            </a> --}}
            @if($userTicket->status == 'open')
            <a title="Closed Ticket" href="javascript:;"
                wire:click="statusTicketConfirm('Closed',{{ $userTicket->id }})" class="btn btn-sm-my btn-danger">
                <i class="fa fa-toggle-off" aria-hidden="true"></i>
            </a>
            @else
            <a title="Open Ticket" href="javascript:;" wire:click="statusTicketConfirm('Open',{{ $userTicket->id }})"
                class="btn btn-sm-my btn-success">
                <i class="fa fa-toggle-on" aria-hidden="true"></i>
            </a>
            @endif
            @endif
        </div>
    </div>

    <!-- Messages -->
    <div class="d-flex flex-column message-box" id="messages" wire:poll.10000ms>
        @if(count($ticketMessagesList) > 0)
        @foreach ($ticketMessagesList as $date => $ticketMessages)
        <div class="mx-auto my-2 bg-primary text-white small py-1 px-2 rounded">
            {{ $date }}
        </div>
        @foreach ($ticketMessages as $ticketMessage)
        @if($ticketMessage->sender_id == auth()->id())
        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item adminTop">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2">
                    @if($ticketMessage->type == "text")
                    {!! $ticketMessage->message !!}
                    @elseif ($ticketMessage->type == "image")
                    <img src="{{ asset('storage/chat_files/'.$ticketMessage->message) }}" class="rounded  img-thumbnail"
                        width="300px" height="300px" />
                    @endif
                </div>
                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white" style="width:75px;">
                    {{ getTimeDiff($ticketMessage->created_at) }}
                </div>
            </div>
        </div>
        @else
        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item adminTop">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2 text-black">
                    @if($ticketMessage->type == "text")
                    {!! $ticketMessage->message !!}
                    @elseif ($ticketMessage->type == "image")
                    <img src="{{ asset('storage/chat_files/'.$ticketMessage->message) }}" class="rounded  img-thumbnail"
                        width="300px" height="300px" />
                    @endif
                </div>
                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-black" style="width:75px;">
                    {{ getTimeDiff($ticketMessage->created_at) }}
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endforeach
        @else
        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
            <div class="d-flex flex-row">
                <div class="body m-1 mr-2 text-black">No Message Found</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Input -->
    @if(isset($userTicket->id) && $userTicket->status == 'open')
    <form method="post">
        @csrf
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
    @endif

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="chatFileUpload" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="upload-file" enctype="multipart/form-data">
                    @csrf
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
                            @error('photo')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="rounded mx-auto d-block img-thumbnail" />
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary myBtn" data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="saveImage()" class="btn btn-success myBtn">
                            <i class="fas fa-paper-plane text-white" style="cursor:pointer;"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        document.addEventListener('livewire:load', function () {
            livewire.on('chatModalOpen', ()=> {
                $('#chatFileUpload').find("form#upload-file")[0].reset();
                $('#chatFileUpload').modal('show');
            });

            livewire.on('chatModalClose', ()=> {
                $('#chatFileUpload').find("form#upload-file")[0].reset();
                $('#chatFileUpload').modal('hide');
            });

            Livewire.on('statusTicketConfirm', (status)=> {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to "+status+" this user ticket !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, '+ status +' it!'
                }).then((result)=> {
                    if (result.isConfirmed) {
                        livewire.emit('statusUserTicket');
                    }
                });
            });
        });
    </script>
    @endpush
</div>