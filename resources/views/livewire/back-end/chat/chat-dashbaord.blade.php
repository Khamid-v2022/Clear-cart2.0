<div>
    @push('css')
    <link rel="stylesheet" href="{{ asset('whatsapp/style.css?t=') }}<?= time() ?>">
    @endpush

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
                            <div class="row">
                                <!-- left part -->
                                <div class="col-12 col-sm-3 col-md-3 d-flex flex-column" id="chat-list-area"
                                    style="position:relative;">
                                    @livewire('back-end.chat.chat-ticket-list',['userTicketId' => $userTicketId])
                                </div>

                                <!-- right part -->
                                <div class="d-none d-sm-flex flex-column col-12 col-sm-9 col-md-9 p-0 h-100"
                                    id="message-area">
                                    @livewire('back-end.chat.chat-body',['userTicketId' => $userTicketId])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>