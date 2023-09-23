@extends('frontend.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('whatsapp/style.css?t=') }}<?= time() ?>">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid" id="main-container">
            <div class="row h-100">
                <div class="col-12 col-sm-4 col-md-4 d-flex flex-column" id="chat-list-area" style="position:relative;">
                    <!-- Navbar -->
                    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
                        <img alt="Profile Photo" class="img-fluid rounded-circle mr-2"
                            style="height:50px; cursor:pointer;" onclick="showProfileSettings()" id="display-pic"
                            src="{{ asset('whatsapp/images/asdsd12f34ASd231.png') }}">
                        <div class="text-black font-weight-bold" id="username">UserName</div>
                        <div class="nav-item dropdown ml-auto">
                            <button class="btn bth-primary newChatButton" type="button">
                                New Chat
                            </button>
                        </div>
                    </div>

                    <div class="row d-flex flex-row align-items-center p-2" id="navbar">
                        <!-- front side search icon input text box -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="basic-addon1" id="search-box">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="chat-list" style="overflow:auto;">

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 34</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-success">Open</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 33</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-black">Closed</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 32</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-warning">Answered</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 31</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-success">Open</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 30</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-black">Closed</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 29</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-warning">Answered</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 28</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-warning">Answered</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>

                        <div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
                            {{-- <img src="{{ asset('whatsapp/images/0923102932_aPRkoW.jpg')}}" alt="Profile Photo"
                                class="img-fluid rounded-circle mr-2" style="height:50px;" /> --}}
                            <div class="w-50">
                                <div class="name">Ticket Id # 27</div>
                                <div class="small last-message">
                                    Other Coin | <span class="text-warning">Answered</span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <div class="small time">4:58 PM</div>
                                <div class="badge badge-success badge-pill small d-none" id="unread-count">2
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-sm-flex flex-column col-12 col-sm-8 col-md-8 p-0 h-100" id="message-area">
                    <div class="w-100 h-100 overlay d-none"></div>

                    <!-- Navbar -->
                    <div class="row d-flex flex-row align-items-center p-2 m-0 w-100" id="navbar">
                        <div class="d-block d-sm-none">
                            <i class="fas fa-arrow-left p-2 mr-2 text-white" style="font-size: 1.5rem; cursor: pointer;"
                                onclick="showChatList()"></i>
                        </div>
                        <a href="#"><img src="{{ asset('whatsapp/images/dsaad212312aGEA12ew.png') }}"
                                alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px;"
                                id="pic"></a>
                        <div class="d-flex flex-column">
                            <div class="text-black font-weight-bold" id="name">New Ticket</div>
                            <div class="text-black small" id="details">last seen 27/03/2018 at 17:28</div>
                        </div>
                        <div class="d-flex flex-row align-items-center ml-auto">
                            <a href="#"><i class="fas fa-paperclip mx-3 text-muted d-none d-md-block"></i></a>
                            <a href="#"><i class="fas fa-ellipsis-v mr-2 mx-sm-3 text-muted"></i></a>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="d-flex flex-column" id="messages">
                        {{-- <div class="mx-auto my-2 bg-primary text-white small py-1 px-2 rounded">
                            25/03/2018
                        </div> --}}

                        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2">New Ticket</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white"
                                    style="width:75px;">
                                    13:20
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mx-auto my-2 bg-primary text-white small py-1 px-2 rounded">
                            27/03/2018
                        </div> --}}

                        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2 text-black">Hello</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-black"
                                    style="width:75px;">
                                    08:11
                                </div>
                            </div>
                        </div>

                        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2">Ticket</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white"
                                    style="width:75px;">
                                    13:20
                                </div>
                            </div>
                        </div>

                        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2 text-black">Yes</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-black"
                                    style="width:75px;">
                                    08:11
                                </div>
                            </div>
                        </div>

                        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2">I need to create new Ticket</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white"
                                    style="width:75px;">
                                    13:20
                                </div>
                            </div>
                        </div>

                        <div class="align-self-start p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2 text-black">Done</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-black"
                                    style="width:75px;">
                                    08:11
                                </div>
                            </div>
                        </div>

                        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2">Okay</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white"
                                    style="width:75px;">
                                    13:20
                                </div>
                            </div>
                        </div>

                        <div class="align-self-end self p-1 my-1 mx-3 rounded bg-white shadow-sm message-item">
                            <div class="options">
                                <a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="body m-1 mr-2">Thanks help me to create this ticket</div>
                                <div class="time ml-auto small text-right flex-shrink-0 align-self-end text-white"
                                    style="width:75px;">
                                    13:20
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Input -->
                    <div class="justify-self-end align-items-center flex-row d-flex" id="input-area">
                        <a href="#">
                            <i class="far fa-smile text-muted px-3" style="font-size:1.5rem;"></i>
                        </a>
                        <input type="text" name="message" id="input" placeholder="Type a message"
                            class="flex-grow-1 border-0 px-3 py-2 my-3 rounded shadow-sm">
                        <i class="fas fa-regular fa-paper-plane text-muted px-3" style="cursor:pointer;"
                            onclick="sendMessage()"></i>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src=" {{ asset('whatsapp/script.js?t=') }}<?= time() ?>"></script>
@endpush