<div>
    @push('css')
    <style>
        .myBtn {
            border-radius: 3px !important;
            padding: 5px 10px;
        }
    </style>
    @endpush
    <div class="container">
        <div class="row">
            @if($isList === true)
            <div class="col-md-12 page-title">
                <!-- add button on right side -->
                <div class="float-left">
                    <h3 class="">
                        {{ __('frontend/user.tickets.list_tickets') }}
                    </h3>
                </div>
                <!-- add button on right side -->
                <div class="float-right">
                    <!-- add button -->
                    <button type="button" wire:click="addUserTicket('add')" class="btn btn-success myBtn">
                        <i class="fas fa-plus"></i> &nbsp;
                        {{ __('frontend/user.tickets.ticket_create') }}
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                @if(count($userTickets))
                <div class="card">
                    <div class="card-header">{{ __('frontend/user.tickets.list_tickets') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-tickets table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('frontend/user.tickets.id') }}</th>
                                        <th scope="col">{{ __('frontend/user.tickets.subject') }}</th>
                                        <th scope="col">{{ __('frontend/user.tickets.status') }}</th>
                                        <th scope="col">{{ __('frontend/user.tickets.date') }}</th>
                                        <th scope="col">{{ __('frontend/user.tickets.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userTickets as $key => $ticket)
                                    <tr
                                        class="@if($ticket->isClosed()) bg-light @elseif($ticket->isReplied()) bg-light-2 @endif">
                                        <th scope="row">#{{ $ticket->id }}</th>

                                        <td>
                                            <a href="#" wire:click="addUserTicket('view',{{ $ticket->id }})">
                                                {{ substr($ticket->subject, 0, 255) }}
                                            </a>
                                        </td>

                                        {{-- <td>{{ $ticket->getCategory()->name }}</td> --}}

                                        <td>
                                            @if($ticket->isClosed())
                                            {{ __('frontend/user.tickets.status_data.closed') }}
                                            @else
                                            @if(!$ticket->isReplied())
                                            {{ __('frontend/user.tickets.status_data.open') }}
                                            @else
                                            {{ __('frontend/user.tickets.status_data.replied') }}
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ticket->getDate() }}
                                        </td>
                                        <td>
                                            <!-- view buttton -->
                                            {{-- <button wire:click="addUserTicket('view',{{ $ticket->id }})"
                                                type="button" title="View" class="btn myBtn btn-primary btn-sm">
                                                <!-- eye icon -->
                                                <i class="fas fa-eye"></i>
                                            </button> --}}

                                            <a href="{{ route('chat.dashboard',Crypt::encryptString($ticket->id)) }}"
                                                title="View" class="btn myBtn btn-primary btn-sm">
                                                <!-- eye icon -->
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- delete buttton -->
                                            <button type="button" title="Delete" class="btn myBtn btn-danger btn-sm"
                                                wire:click="deleteUserTicketConfirm({{ $ticket->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $userTickets->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                @else
                <div class="alert alert-warning">
                    {{ __('frontend/user.tickets.no_tickets_exists') }}
                </div>
                @endif
            </div>
            @endif

            @if($isShow === true)
            <div class="col-md-12 page-title">
                <!-- add button on right side -->
                <div class="float-left">
                    <h3 class="">
                        {{ __('frontend/user.tickets.list_tickets') }}
                    </h3>
                </div>
                <div class="float-right">
                    <button wire:click="cancelInsert()" type="button" title="Close"
                        class="btn myBtn btn-warning btn-sm">
                        <!-- back icon -->
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        {{ __('frontend/user.tickets.back_to_list') }}
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('frontend/user.tickets.ticket_create') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="subject">{{ __('frontend/user.tickets.subject') }}</label>
                                <input wire:model='subject'
                                    class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" value=""
                                    name="subject" id="subject" required autofocus />
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message">{{ __('frontend/user.tickets.message') }}</label>
                                <textarea wire:model='content'
                                    class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                    name="content" id="content" rows="3" required></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group" wire:ignore>
                                <label for="captcha">{{ __('frontend/main.captcha') }}</label>
                                <div class="captcha-img">
                                    {!! captcha_img('math') !!}
                                </div>
                                <input type="text"
                                    class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}"
                                    name="captcha" id="captcha" required />
                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="text-left">
                                <button wire:click.prevent="storeUserTicket()" class="btn myBtn btn-success"
                                    type="submit">
                                    <i class="fas fa-plus"></i> &nbsp;
                                    {{ __('frontend/user.tickets.create_button') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            @if($isView === true)
            <div class="col-md-12 page-title">
                <!-- add button on right side -->
                <div class="float-left">
                    <h3 class="">
                        {{ __('frontend/user.tickets.list_tickets') }}
                    </h3>
                </div>
                <div class="float-right">
                    <button wire:click="cancelInsert()" type="button" title="Close"
                        class="btn myBtn btn-warning btn-sm">
                        <!-- back icon -->
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        {{ __('frontend/user.tickets.back_to_list') }}
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('frontend/user.tickets.ticket_view') }}
                        <div class="card-body">
                            {{ $userTicket->subject }}
                            <div class="ticket-reply">
                                {!! nl2br(strlen($userTicket->content) > 0 ? e(decrypt($userTicket->content)) : '') !!}
                                <span class="ticket-reply-span">{{ $userTicket->getDateTime() }}</span>
                            </div>


                            @if(count($userTicket->ticketReplies) > 0)
                            <hr />
                            @endif

                            @foreach($userTicket->ticketReplies as $ticketReply)
                            <div
                                class="ticket-reply @if($ticketReply->user_id == Auth::user()->id)  @else ticket-reply-answer @endif">
                                {!! nl2br(strlen($ticketReply->content) > 0 ? e(decrypt($ticketReply->content)) : '')
                                !!}

                                <span class="ticket-reply-span">{{ $ticketReply->getDateTime() }}</span>
                            </div>
                            @endforeach

                            @if(!$userTicket->isClosed())
                            <hr />
                            <h5>{{ __('frontend/user.tickets.reply_title') }}</h5>
                            <form method="POST" action="#" id="reply-form">
                                @csrf
                                <div class="form-group">
                                    <label for="message">{{ __('frontend/user.tickets.message') }}</label>
                                    <textarea wire:model='replyMessage'
                                        class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                        name="message" id="message" rows="3" required autofocus></textarea>
                                    @error('replyMessage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" wire:ignore>
                                    <label for="captcha">{{ __('frontend/main.captcha') }}</label>
                                    <div class="captcha-img">
                                        {!! captcha_img('math') !!}
                                    </div>
                                    <input wire:model='captcha' type="text"
                                        class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}"
                                        name="captcha" id="captcha" required />

                                    @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="text-left">
                                    <button wire:click.prevent="storeUserTicketReplay()" class="btn myBtn btn-success"
                                        type="submit">
                                        <i class="fas fa-plus"></i> &nbsp;
                                        {{ __('frontend/user.tickets.reply_button') }}
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @push('js')
        <script>
            document.addEventListener('livewire:load', () => {
            Livewire.on('deleteUserTicketConfirm', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this user ticket !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emit('deleteUserTicket');
                    }
                });
            });

            Livewire.on('resetReplyForm', () => {
                $("form#reply-form")[0].reset();
            });
        });
        </script>
        @endpush
    </div>
</div>