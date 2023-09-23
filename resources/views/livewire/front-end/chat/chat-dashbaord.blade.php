<div>
    @push('css')
    <link rel="stylesheet" href="{{ asset('whatsapp/style.css?t=') }}<?= time() ?>">
    @endpush

    <div class="container">
        <div class="row">
            <div class="col-md-12 page-title">
                <!-- add button on right side -->
                <div class="float-left">
                    <h3 class="">
                        {{ __('frontend/user.tickets.list_tickets') }}
                    </h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('frontend/user.tickets.list_tickets') }}
                    </div>
                    <div class="card-body">
                        <div class="row h-100">
                            <!-- left part -->
                            <div class="col-12 col-sm-3 col-md-3 d-flex flex-column" id="chat-list-area"
                                style="position:relative;">
                                @livewire('front-end.chat.chat-ticket-list',['userTicketId' => $userTicketId])
                            </div>

                            <!-- right part -->
                            <div class="d-none d-sm-flex flex-column col-12 col-sm-9 col-md-9 p-0 h-100"
                                id="message-area">
                                @livewire('front-end.chat.chat-body',['userTicketId' => $userTicketId])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>