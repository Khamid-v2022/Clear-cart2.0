<?php

namespace App\Http\Controllers\Livewire\BackEnd\Chat;

use App\Models\ChatMessage;
use App\Models\UserTicket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatTicketList extends Component
{
    public $ticketList        = null;
    public $isNew             = false;
    public $subject           = null;
    public $content           = null;
    public $search_ticket     = null;
    public $userTicketId      = null;
    public $ticketUnreadCount = [];

    protected $listeners = [
        'storeUserTicket' => 'storeUserTicket',
        'refresh'         => '$refresh',
    ];

    /**
     * add new ticket
     *
     * @param string $userTicketId
     * @return void
     *
     */
    public function mount($userTicketId = null)
    {
        if ($userTicketId != '') {
            $this->updateBody($userTicketId);
        }
    }

    /**
     * add new ticket
     *
     * @return void
     *
     */
    public function newTicket()
    {
        $this->emit('userTicketConfirm');
    }

    /**
     * update body by ticket id
     *
     * @param integer $userTicketId
     * @return void
     *
     */
    public function updateBody(int $userTicketId)
    {
        $this->userTicketId = $userTicketId;
        ChatMessage::where('ticket_id', $userTicketId)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->where('receiver_read', 0)
            ->update(['receiver_read' => 1]);
        $this->emitTo('back-end.chat.chat-body', 'updateBody', $userTicketId);
    }

    /**
     * render view
     *
     * @return void
     *
     */
    public function render()
    {
        $this->ticketList = ChatMessage::select("chat_messages.ticket_id", "users_tickets.status", "users_tickets.created_at")
            ->leftJoin("users_tickets", "users_tickets.id", "=", "chat_messages.ticket_id")
            ->where(function ($query) {
                $query->where('chat_messages.sender_id', auth()->id())
                    ->orWhere('chat_messages.receiver_id', auth()->id());
            });

        if ($this->search_ticket) {
            $this->ticketList = $this->ticketList->where('chat_messages.ticket_id', 'like', '%' . $this->search_ticket . '%');
        }

        $this->ticketList = $this->ticketList->distinct("chat_messages.ticket_id")
            ->orderBy('chat_messages.updated_at', 'desc')
            ->get();

        $this->ticketUnreadCount = ChatMessage::select("chat_messages.ticket_id", DB::Raw('count(*) as unread_count'))
            ->where(function ($query) {
                $query->where('chat_messages.sender_id', auth()->id())
                    ->orWhere('chat_messages.receiver_id', auth()->id());
            })
            ->where('chat_messages.receiver_read', 0)
            ->groupBy('chat_messages.ticket_id')
            ->pluck('unread_count', 'ticket_id')
            ->all();

        return view('livewire.back-end.chat.chat-ticket-list');
    }
}