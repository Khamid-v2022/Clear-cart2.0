<div>
    <!-- Navbar -->
    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
        <div id="profileImage">
            {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="text-black font-weight-bold userName" id="username">
            {{ ucfirst(auth()->user()->username) }}
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
        @if((isset($ticketFirstList) && $ticketFirstList->count() > 0) || isset($ticketSecondList) &&
        $ticketSecondList->count() > 0)
        <!-- first list -->
        @if(isset($ticketFirstList) && $ticketFirstList->count() > 0)
        @foreach ($ticketFirstList as $ticket)
        <div wire:click="updateBody({{ $ticket->ticket_id }})"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom @if($userTicketId != '' && $userTicketId == $ticket->ticket_id) chatActive @endif">
            <div class="w-50">
                <div class="name">Ticket Id # {{ $ticket->ticket_id }} </div>
                <div class="small last-message">
                    {{ ucfirst($ticket->user_name) }} |
                    @if($ticket->status == 'open')
                    <span class="ticketStatus text-success">Open</span>
                    @else
                    <span class="ticketStatus text-black">Closed</span>
                    @endif
                </div>
            </div>
            <div class="flex-grow-1 text-right">
                <div class="small time">
                    {{ getTimeDiff($ticket->updated_at) }}
                </div>
                @if(isset($ticketUnreadCount[$ticket->ticket_id]) && $ticketUnreadCount[$ticket->ticket_id] > 0)
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    {{ $ticketUnreadCount[$ticket->ticket_id] }}
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif

        <!-- Second List -->
        @if(isset($ticketSecondList) && $ticketSecondList->count() > 0)
        @foreach ($ticketSecondList as $ticket)
        <div wire:click="updateBody({{ $ticket->ticket_id }})"
            class="chat-list-item d-flex flex-row w-100 p-2 border-bottom @if($userTicketId != '' && $userTicketId == $ticket->ticket_id) chatActive @endif">
            <div class="w-50">
                <div class="name">Ticket Id # {{ $ticket->ticket_id }} </div>
                <div class="small last-message">
                    {{ ucfirst($ticket->user_name) }} |
                    @if($ticket->status == 'open')
                    <span class="ticketStatus text-success">Open</span>
                    @else
                    <span class="ticketStatus text-black">Closed</span>
                    @endif
                </div>
            </div>
            <div class="flex-grow-1 text-right">
                <div class="small time">
                    {{ getTimeDiff($ticket->ticket_updated_at) }}
                </div>
                @if(isset($ticketUnreadCount[$ticket->ticket_id]) && $ticketUnreadCount[$ticket->ticket_id] > 0)
                <div class="badge badge-danger badge-pill small" id="unread-count">
                    {{ $ticketUnreadCount[$ticket->ticket_id] }}
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif
        @else
        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
            <div class="w-50">
                <div class="name">No Ticket Found</div>
            </div>
        </div>
        @endif
    </div>

    @push('js')
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
    @endpush
</div>