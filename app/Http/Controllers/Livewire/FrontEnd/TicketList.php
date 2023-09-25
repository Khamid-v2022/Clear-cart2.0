<?php

namespace App\Http\Controllers\Livewire\FrontEnd;

use App\Models\ChatMessage;
use App\Models\UserTicket;
use App\Models\UserTicketReply;
use Livewire\Component;
use Livewire\WithPagination;

class TicketList extends Component
{
    use WithPagination;

    public $isAction     = null;
    public $isList       = true;
    public $ticketId     = null;
    public $isConfirm    = false;
    public $userTicketId = null;
    public $isShow       = false;
    public $subject      = null;
    public $content      = null;
    public $captcha      = null;
    public $isView       = false;
    public $userTicket   = null;
    public $replyMessage = null;

    protected $listeners = [
        'deleteUserTicket' => 'deleteUserTicket',
    ];

    /**
     * add user ticket
     *
     * @param string $userTicketId
     * @return void
     *
     */
    public function addUserTicket($action, string $userTicketId = null)
    {
        $this->isView = false;
        $this->isShow = false;

        if ($action == "view") {
            $this->isView = true;
        } else {
            $this->isShow = true;
        }
        $this->isList = false;

        if ($userTicketId != "") {
            $this->userTicketId = $userTicketId;
            $userTicket         = UserTicket::find($userTicketId);
            $this->userTicket   = $userTicket;
            $this->subject      = $userTicket->subject;
            $this->content      = decrypt($userTicket->content);
        }
    }

    public function cancelInsert()
    {
        $this->resetInputFields();
        $this->isList = true;
        $this->isShow = false;
        $this->isView = false;
        $this->emit('resetReplyForm');
    }

    /**
     * reset input fields
     *
     * @return void
     *
     */
    private function resetInputFields()
    {
        $this->isShow       = false;
        $this->subject      = null;
        $this->content      = null;
        $this->replyMessage = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * [rules description]
     * @return [type] [description]
     */
    protected function rules()
    {
        $rules = [
            'subject' => "required",
            'content' => 'required',
        ];

        return $rules;
    }

    /**
     * [$messages description]
     * @var [type]
     */
    protected $messages = [
        'subject.required' => 'The field is required.',
        'content.required' => 'The field is required.',
    ];

    /**
     * store user ticket
     *
     * @return void
     *
     */
    public function storeUserTicket()
    {
        $this->validate();

        $success = "User Ticket Add Successfully";

        $isNew = false;

        if ($this->userTicketId != "") {
            $userTicket = UserTicket::find($this->userTicketId);
            $success    = "User Ticket Update Successfully";
        } else {
            $userTicket             = new UserTicket();
            $userTicket->created_at = date("Y-m-d H:i:s");
            $isNew                  = true;
        }
        $userTicket->user_id    = auth()->id();
        $userTicket->subject    = $this->subject;
        $userTicket->content    = encrypt($this->content);
        $userTicket->updated_at = date("Y-m-d H:i:s");
        $userTicket->save();

        if ($this->userTicketId == "" && $isNew) {
            $chatMessage               = new ChatMessage();
            $chatMessage->ticket_id    = $userTicket->id;
            $chatMessage->sender_id    = auth()->id();
            $chatMessage->receiver_id  = getRandomAdmin();
            $chatMessage->message      = $this->subject;
            $chatMessage->type         = "text";
            $chatMessage->message_date = date("Y-m-d");
            $chatMessage->created_at   = date("Y-m-d H:i:s");
            $chatMessage->updated_at   = date("Y-m-d H:i:s");
            $chatMessage->save();
        }

        $this->resetInputFields();

        $this->isList = true;
        $this->isShow = false;

        $this->emit('showSuccessMsg', "$success");
    }

    /**
     * store user ticket replay
     *
     * @return void
     *
     */
    public function storeUserTicketReplay()
    {
        $this->validate([
            'replyMessage' => 'required',
        ]);

        $userTicketReply            = new UserTicketReply();
        $userTicketReply->user_id   = auth()->id();
        $userTicketReply->ticket_id = $this->userTicketId;
        $userTicketReply->content   = encrypt($this->replyMessage);
        $userTicketReply->save();

        $this->replyMessage = null;

        $this->userTicket = UserTicket::find($this->userTicketId);

        $this->emit('showSuccessMsg', "User Ticket Replay Store Successfully");

        $this->emit('resetReplyForm');
    }

    /**
     * delete user ticket confirm
     *
     * @param boolean $status
     * @param int $userTicketId
     * @return void
     *
     */
    public function deleteUserTicketConfirm(int $userTicketId = null)
    {
        $this->userTicketId = null;

        if ($userTicketId != null) {
            $this->userTicketId = $userTicketId;
        }

        $this->emit('deleteUserTicketConfirm', 'are u sure?', 'warning');
    }

    /**
     * delete user ticket
     *
     * @return void
     *
     */
    public function deleteUserTicket()
    {
        $userTicket = UserTicket::find($this->userTicketId);
        if ($userTicket) {
            ChatMessage::where('ticket_id', $userTicket->id)->delete();
            $userTicket->delete();
        }

        $this->userTicketId = null;

        $this->emit('showSuccessMsg', "UserTicket Delete Successfully");
    }

    /**
     * render function
     *
     * @return void
     *
     */
    public function render()
    {
        $userTickets = UserTicket::where('user_id', auth()->id())
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('livewire.front-end.ticket-list', compact('userTickets'))
            ->extends('frontend.layouts.app')
            ->section('content');
    }
}
