<?php

namespace App\Http\Controllers\Livewire\BackEnd\Chat;

use App\Models\ChatMessage;
use App\Models\UserTicket;
use Livewire\Component;

class ChatDashbaord extends Component
{
    public $userTicketId;
    public $userTicket = null;

    /**
     * render view
     *
     * @return void
     *
     */
    public function render()
    {
        $userTicket = ChatMessage::where('receiver_id', auth()->id())
            ->orderBy('id', 'desc')
            ->first();

        if ($userTicket) {

            $userTicketId     = $userTicket->ticket_id;
            $this->userTicket = UserTicket::find($userTicketId);

            if ($this->userTicket) {
                $this->userTicketId = $this->userTicket->id;
            }
        }

        return view('livewire.back-end.chat.chat-dashbaord')
            ->extends('backend.layouts.default')
            ->section('content');
    }
}