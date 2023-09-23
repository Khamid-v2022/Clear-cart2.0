<div>
    @if($isList === true)
    <div class="k-content__head	k-grid__item">
        <div class="k-content__head-main">
            <h3 class="k-content__head-title">
                {{ __('backend/management.tickets.title') }}
            </h3>
            <div class="k-content__head-breadcrumbs">
                <a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
                <span class="k-content__head-breadcrumb-separator"></span>
                <a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
            </div>
        </div>
    </div>
    <div class="k-content__body	k-grid__item k-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">

                            @if(count($userTickets))
                            <table class="table table-head-noborder">
                                <thead>
                                    <tr>
                                        <th>{{ __('backend/management.tickets.id') }}</th>
                                        <th>{{ __('backend/management.tickets.user') }}</th>
                                        <th>{{ __('backend/management.tickets.subject') }}</th>
                                        <th>{{ __('backend/management.tickets.status') }}</th>
                                        <th>{{ __('backend/management.tickets.date') }}</th>
                                        <th>{{ __('backend/management.tickets.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userTickets as $ticket)
                                    <tr>
                                        <th scope="row">{{ $ticket->id }}</th>
                                        <td>
                                            {{ $ticket->getUser()->username }}
                                        </td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>
                                            @if($ticket->isClosed())
                                            <span class="kt-badge kt-badge--danger kt-badge--dot kt-badge--md"></span>
                                            <span class="kt-label-font-color-2 kt-font-bold">{{
                                                __('backend/management.tickets.status_data.closed') }}</span>
                                            @elseif($ticket->isReplied())
                                            <span class="kt-badge kt-badge--brand kt-badge--dot kt-badge--md"></span>
                                            <span class="kt-label-font-color-2 kt-font-bold">{{
                                                __('backend/management.tickets.status_data.replied') }}</span>
                                            @else
                                            <span class="kt-badge kt-badge--success kt-badge--dot kt-badge--md"></span>
                                            <span class="kt-label-font-color-2 kt-font-bold">{{
                                                __('backend/management.tickets.status_data.open') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ticket->created_at->format('d.m.Y H:i') }}
                                        </td>
                                        <td style="font-size: 20px;">
                                            <!-- view buttton -->
                                            {{-- <button wire:click="editUserTicket({{ $ticket->id }})" type="button"
                                                title="View" class="btn myBtn btn-success btn-sm">
                                                <!-- pencil icon -->
                                                <i class="fas fa-edit"></i>
                                            </button> --}}

                                            <a href="{{ route('admin.chat.dashbaord',Crypt::encryptString($ticket->id)) }}"
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
                            {{ $userTickets->links('vendor.pagination.bootstrap-4') }}

                            @else
                            <i>{{ __('backend/main.no_entries') }}</i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($isShow === true)
    <div class="k-content__head	k-grid__item">
        <div class="k-content__head-main">
            <h3 class="k-content__head-title">
                {{ __('backend/management.tickets.edit.title') }}
        </div>
    </div>

    <div class="k-content__body	k-grid__item k-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
                @if(!$userTicket->isClosed())
                <button wire:click="userTicketActionConfirm('closed')"
                    class="btn btn-wide btn-bold btn-danger btn-upper" style="margin-bottom:15px">
                    <i class="fas fa-solid fa-lock"></i>
                    {{ __('backend/management.tickets.edit.close') }}
                </button>
                @else
                <button wire:click="userTicketActionConfirm('open')" class="btn btn-wide btn-bold btn-success btn-upper"
                    style="margin-bottom:15px">
                    <i class="fas fa-solid fa-unlock"></i>
                    {{ __('backend/management.tickets.edit.open') }}
                </button>
                @endif

                <div class="float-right">
                    <button wire:click="cancelInsert()" class="btn btn-wide btn-bold btn-primary btn-upper"
                        style="margin-bottom:15px">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        {{ __('frontend/user.tickets.back_to_list') }}
                    </button>
                </div>

                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                {{ $userTicket->subject }}
                            </h3>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fluid">
                        <div style="width: 100%">
                            <div class="card">
                                <div class="card-body">
                                    <p>{!! nl2br(strlen($userTicket->content) > 0 ? e(decrypt($userTicket->content)) :
                                        '') !!}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ $userTicket->getDateTime() }} | {{ $userTicket->getUser()->name }}
                                </div>
                            </div>

                            <hr />

                            @foreach($userTicket->ticketReplies as $ticketReply)
                            <div class="card">
                                <div class="card-body"
                                    style="@if($ticketReply->user_id == Auth::user()->id) background-color: #f2f2f2 !important; @endif">
                                    <p>{!! nl2br(strlen($ticketReply->content) > 0 ? e(decrypt($ticketReply->content)) :
                                        '')
                                        !!}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ $ticketReply->getDateTime() }} | {{ $ticketReply->getUser()->name }}
                                </div>
                            </div>

                            <hr />
                            @endforeach

                            <h5>{{ __('backend/management.tickets.edit.title_reply') }}</h5>

                            <form method="POST" class="kt-form" action="#" style="width: 100%">
                                @csrf

                                <div class="form-group" style="width: 100%">
                                    <label for="ticket_reply_msg">{{ __('backend/management.tickets.edit.message')
                                        }}</label>
                                    <textarea wire:model='replyMessage' style="width: 100%"
                                        class="form-control @if($errors->has('ticket_reply_msg')) is-invalid @endif"
                                        id="ticket_reply_msg" name="ticket_reply_msg"
                                        placeholder="{{ __('backend/management.tickets.edit.message') }}">{{ old('ticket_reply_msg') }}</textarea>
                                    @error('replyMessage')
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button wire:click.prevent="storeUserTicketReply()" type="submit"
                                    class="btn btn-wide btn-bold btn-danger">{{
                                    __('backend/management.tickets.edit.submit_button') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('js')
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('userTicketActionConfirm', (status) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to "+ status +" this user ticket !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, '+status+' it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emit('userTicketAction');
                    }
                });
            });

            Livewire.on('deleteUserTicketConfirm', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this user ticket !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#c82333',
                    confirmButtonText: 'Yes, delete it!',
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