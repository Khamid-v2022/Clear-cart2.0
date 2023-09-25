<?php

namespace App\Http\Controllers\Livewire\FrontEnd\Chat;

use App\Models\UserTicket;
use Livewire\Component;

class ChatDashbaord extends Component
{
    public $userTicketId = null;
    public $userTicket   = null;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    /**
     * render view
     *
     * @return void
     *
     */
    public function render()
    {
        $this->userTicket = UserTicket::where('user_id', auth()->id())
            ->orderBy('updated_at', 'DESC')
            ->first();

        if ($this->userTicket) {
            $this->userTicketId = $this->userTicket->id;
        }

        return view('livewire.front-end.chat.chat-dashbaord')
            ->extends('frontend.layouts.app')
            ->section('content');
    }
}
