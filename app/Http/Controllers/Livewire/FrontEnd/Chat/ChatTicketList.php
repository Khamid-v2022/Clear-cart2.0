<?php

namespace App\Http\Controllers\Livewire\FrontEnd\Chat;

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
    public $userTicketId         = null;
    public $search_ticket        = null;
    public $ticketUnreadCount    = [];
    public $ticketUnreadCountIds = [];

    protected $listeners = [
        'storeUserTicket' => 'storeUserTicket',
        'refresh'         => '$refresh',
    ];

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
            ->where('sender_read', 0)
            ->update(['sender_read' => 1]);
        $this->emitTo('front-end.chat.chat-body', 'updateBody', $userTicketId);
        $this->emitSelf('refresh');
    }

    /**
     * store user ticket
     *
     * @return void
     *
     */
    public function storeUserTicket(string $subject)
    {
        $success = "User Ticket Add Successfully";

        $userTicket             = new UserTicket();
        $userTicket->user_id    = auth()->id();
        $userTicket->subject    = $subject;
        $userTicket->created_at = date("Y-m-d H:i:s");
        $userTicket->updated_at = date("Y-m-d H:i:s");
        $userTicket->save();

        $chatMessage                = new ChatMessage();
        $chatMessage->ticket_id     = $userTicket->id;
        $chatMessage->sender_id     = auth()->id();
        $chatMessage->receiver_id   = getRandomAdmin();
        $chatMessage->message       = $subject;
        $chatMessage->type          = "text";
        $chatMessage->sender_read   = "1";
        $chatMessage->receiver_read = "0";
        $chatMessage->message_date  = date("Y-m-d");
        $chatMessage->created_at    = date("Y-m-d H:i:s");
        $chatMessage->updated_at    = date("Y-m-d H:i:s");
        $chatMessage->save();

        $this->updateBody($userTicket->id);

        $this->emit('showSuccessMsg', "$success");

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
            ->where('sender_read', 0)
            ->groupBy('ticket_id')
            ->having('unread_count', '>', 0)
            ->pluck('ticket_id')
            ->all();

        $this->ticketFirstList  = null;
        $this->ticketSecondList = null;

        if (count($this->ticketUnreadCountIds) > 0) {
            $this->ticketFirstList = UserTicket::where('user_id', auth()->id())
                ->whereIn('id', $this->ticketUnreadCountIds);

            if ($this->search_ticket) {
                $this->ticketFirstList->where('id', 'like', "%$this->search_ticket%");
            }

            $this->ticketFirstList = $this->ticketFirstList->orderBy('updated_at', 'DESC')
                ->get();
        }

        $this->ticketSecondList = UserTicket::where('user_id', auth()->id())
            ->whereNotIn('id', $this->ticketUnreadCountIds);

        if ($this->search_ticket) {
            $this->ticketSecondList->where('id', 'like', "%$this->search_ticket%");
        }

        $this->ticketSecondList = $this->ticketSecondList->orderBy('updated_at', 'DESC')->get();

        $this->ticketUnreadCount = ChatMessage::select("chat_messages.ticket_id", DB::Raw('count(*) as unread_count'))
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->where('sender_read', 0)
            ->groupBy('ticket_id')
            ->pluck('unread_count', 'ticket_id')
            ->all();

        return view('livewire.front-end.chat.chat-ticket-list');
    }
}
