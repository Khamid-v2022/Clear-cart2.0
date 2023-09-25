<?php

namespace App\Http\Controllers\Livewire\BackEnd\Chat;

use App\Models\ChatMessage;
use App\Models\UserTicket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatTicketList extends Component
{
    public $ticketFirstList      = null;
    public $ticketSecondList     = null;
    public $isNew                = false;
    public $subject              = null;
    public $content              = null;
    public $search_ticket        = null;
    public $userTicketId         = null;
    public $ticketUnreadCount    = [];
    public $ticketUnreadCountIds = [];

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
        $this->emitSelf('refresh');
    }

    /**
     * render view
     *
     * @return void
     *
     */
    public function render()
    {
        $this->ticketUnreadCountIds = [];

        $this->ticketUnreadCountIds = ChatMessage::select("chat_messages.ticket_id", DB::Raw('count(*) as unread_count'))
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->where('receiver_read', 0)
            ->groupBy('ticket_id')
            ->having('unread_count', '>', 0)
            ->pluck('ticket_id')
            ->all();

        $this->ticketFirstList  = null;
        $this->ticketSecondList = null;

        if (count($this->ticketUnreadCountIds) > 0) {
            $this->ticketFirstList = ChatMessage::select("chat_messages.ticket_id", "users_tickets.status", "users_tickets.updated_at as ticket_updated_at", "users.username as user_name")
                ->leftJoin("users_tickets", "users_tickets.id", "=", "chat_messages.ticket_id")
                ->leftJoin("users", "users.id", "=", "users_tickets.user_id")
                ->where(function ($query) {
                    $query->where('chat_messages.sender_id', auth()->id())
                        ->orWhere('chat_messages.receiver_id', auth()->id());
                })
                ->whereIn('chat_messages.ticket_id', $this->ticketUnreadCountIds);

            if ($this->search_ticket) {
                $this->ticketFirstList = $this->ticketFirstList->where(function ($query) {
                    $query->where('chat_messages.ticket_id', 'like', '%' . $this->search_ticket . '%')
                        ->orWhere('users.username', 'like', '%' . $this->search_ticket . '%');
                });
            }

            $this->ticketFirstList = $this->ticketFirstList->distinct("chat_messages.ticket_id")
                ->orderBy('users_tickets.updated_at', 'DESC')
                ->get();
        }

        $this->ticketSecondList = ChatMessage::select("chat_messages.ticket_id", "users_tickets.status", "users_tickets.updated_at as ticket_updated_at", "users.username as user_name")
            ->leftJoin("users_tickets", "users_tickets.id", "=", "chat_messages.ticket_id")
            ->leftJoin("users", "users.id", "=", "users_tickets.user_id")
            ->where(function ($query) {
                $query->where('chat_messages.sender_id', auth()->id())
                    ->orWhere('chat_messages.receiver_id', auth()->id());
            })
            ->whereNotIn('chat_messages.ticket_id', $this->ticketUnreadCountIds);

        if ($this->search_ticket) {
            $this->ticketSecondList = $this->ticketSecondList->where(function ($query) {
                $query->where('chat_messages.ticket_id', 'like', '%' . $this->search_ticket . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search_ticket . '%');
            });
        }

        $this->ticketSecondList = $this->ticketSecondList->distinct("chat_messages.ticket_id")
            ->orderBy('users_tickets.updated_at', 'DESC')
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
