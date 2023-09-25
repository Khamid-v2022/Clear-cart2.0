<?php

namespace App\Http\Controllers\Livewire\FrontEnd\Chat;

use App\Models\ChatMessage;
use App\Models\Setting;
use App\Models\UserTicket;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatBody extends Component
{
    use WithFileUploads;

    public $userTicket         = null;
    public $userTicketId       = null;
    public $ticketMessagesList = [];
    public $message            = '';
    public $photo              = null;
    public $deleteTicketId     = null;
    public $appName            = null;

    protected $listeners = [
        'deleteUserTicket' => 'deleteUserTicket',
        'updateBody'       => 'updateBody',
        'refresh'          => '$refresh',
    ];

    /**
     * get app name
     *
     * @return void
     *
     */
    public function mount($userTicketId = null)
    {
        $this->appName = Setting::get('app.name');
        if ($userTicketId != '') {
            $this->updateBody($userTicketId);
        }
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
        $this->message      = '';
        $this->userTicketId = $userTicketId;
        $this->userTicket   = UserTicket::find($userTicketId);
        $this->emitSelf('refresh');
    }

    /**
     * store message
     *
     * @return void
     *
     */
    public function storeMessage()
    {
        $this->validate([
            'message' => 'required',
        ]);

        $date                       = date('Y-m-d');
        $chatMessage                = new ChatMessage();
        $chatMessage->ticket_id     = $this->userTicketId;
        $chatMessage->sender_id     = auth()->id();
        $chatMessage->receiver_id   = getRandomAdmin();
        $chatMessage->message       = $this->message;
        $chatMessage->type          = "text";
        $chatMessage->sender_read   = "1";
        $chatMessage->receiver_read = "0";
        $chatMessage->message_date  = date("Y-m-d");
        $chatMessage->created_at    = date("Y-m-d H:i:s");
        $chatMessage->updated_at    = date("Y-m-d H:i:s");
        $chatMessage->save();

        $this->updateTicketTime();

        $this->ticketMessagesList[$date][] = $chatMessage;

        $this->message = '';
    }

    /**
     * render for livewire
     *
     * @return void
     *
     */
    public function render()
    {
        $this->setMessages();

        return view('livewire.front-end.chat.chat-body');
    }

    /**
     * set messages
     *
     * @return void
     *
     */
    public function setMessages()
    {
        ChatMessage::where('ticket_id', $this->userTicketId)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->where('sender_read', 0)
            ->update(['sender_read' => 1]);

        $this->ticketMessagesList = [];

        $dates = ChatMessage::select("message_date")
            ->where("ticket_id", $this->userTicketId)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->distinct("message_date")
            ->orderBy("message_date", "asc")
            ->pluck("message_date")
            ->all();

        if (count($dates) > 0) {
            foreach ($dates as $date) {
                $this->ticketMessagesList[$date] = ChatMessage::where("chat_messages.ticket_id", $this->userTicketId)
                    ->where("chat_messages.message_date", $date)
                    ->where(function ($query) {
                        $query->where('chat_messages.sender_id', auth()->id())
                            ->orWhere('chat_messages.receiver_id', auth()->id());
                    })
                    ->orderBy("chat_messages.created_at", "asc")
                    ->get();
            }
        }
    }

    /**
     * open file modal
     *
     * @return void
     *
     */
    public function chatModalOpen()
    {
        $this->emit('chatModalOpen');
    }

    /**
     * close file modal
     *
     * @return void
     *
     */
    public function closeFileModal()
    {
        $this->photo = null;
    }

    /**
     * open file modal
     *
     * @return void
     *
     */
    public function saveImage()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $storagePath = storage_path('app/public/chat_files/');
        makeDir($storagePath);

        $this->photo->store('chat_files');

        $date                       = date('Y-m-d');
        $chatMessage                = new ChatMessage();
        $chatMessage->ticket_id     = $this->userTicketId;
        $chatMessage->sender_id     = auth()->id();
        $chatMessage->receiver_id   = getRandomAdmin();
        $chatMessage->message       = $this->photo->hashName();
        $chatMessage->type          = "image";
        $chatMessage->sender_read   = "1";
        $chatMessage->receiver_read = "0";
        $chatMessage->message_date  = date("Y-m-d");
        $chatMessage->created_at    = date("Y-m-d H:i:s");
        $chatMessage->updated_at    = date("Y-m-d H:i:s");
        $chatMessage->save();

        $this->ticketMessagesList[$date][] = $chatMessage;

        $this->updateTicketTime();

        $this->emit('chatModalClose');
    }

    /**
     * update ticket time
     *
     * @return void
     *
     */
    public function updateTicketTime()
    {
        $this->userTicket->updated_at = date("Y-m-d H:i:s");
        $this->userTicket->save();

        $this->emitTo('front-end.chat.chat-ticket-list', 'refresh');
    }

    /**
     * delete user ticket confirm
     *
     * @param boolean $status
     * @param int $deleteTicketId
     * @return void
     *
     */
    public function deleteTicketConfirm(int $deleteTicketId = null)
    {
        $this->deleteTicketId = null;

        if ($deleteTicketId != null) {
            $this->deleteTicketId = $deleteTicketId;
        }

        $this->emit('deleteTicketConfirm');
    }

    /**
     * close user ticket
     *
     * @return void
     *
     */
    public function deleteUserTicket()
    {
        $userTicket = UserTicket::find($this->deleteTicketId);
        if ($userTicket) {
            ChatMessage::where('ticket_id', $userTicket->id)->delete();
            $userTicket->delete();
        }
        $this->deleteTicketId = null;
        $this->emit('showSuccessMsg', "User Ticket Delete Successfully");
        $this->emitTo('front-end.chat.chat-ticket-list', 'refresh');
        $this->userTicketId = null;
        $this->userTicket   = null;
        $this->emitSelf('refresh');
    }
}
