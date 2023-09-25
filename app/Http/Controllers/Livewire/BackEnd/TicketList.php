<?php

namespace App\Http\Controllers\Livewire\BackEnd;

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
    public $actionStatus = null;

    protected $listeners = [
        'deleteUserTicket' => 'deleteUserTicket',
        'userTicketAction' => 'userTicketAction',
    ];

    public function cancelInsert()
    {
        $this->isShow = false;
        $this->isList = true;
    }

    /**
     * edit user ticket
     *
     * @param string $userTicketId
     * @return void
     *
     */
    public function editUserTicket(string $userTicketId = null)
    {
        $this->isShow = true;
        $this->isList = false;

        if ($userTicketId != "") {
            $this->userTicketId = $userTicketId;
            $userTicket         = UserTicket::find($userTicketId);
            $this->userTicket   = $userTicket;
            $this->subject      = $userTicket->subject;
            $this->content      = decrypt($userTicket->content);
        }
    }

    /**
     * update user ticket confirm
     *
     * @param boolean $status
     * @param int $userTicketId
     * @return void
     *
     */
    public function userTicketActionConfirm(string $status = null)
    {
        $this->actionStatus = $status;

        if ($status != "") {
            $this->emit('userTicketActionConfirm', $status);
        }
    }

    /**
     * update user ticket
     *
     * @param string $status
     * @return void
     *
     */
    public function userTicketAction()
    {
        $status     = $this->actionStatus;
        $userTicket = UserTicket::find($this->userTicketId);
        if ($userTicket) {
            $userTicket->status = $this->actionStatus;
            $userTicket->save();
            $this->actionStatus = null;
            $this->userTicket   = $userTicket;
        }

        $this->emit('showSuccessMsg', "User Ticket $status Successfully");
    }

    /**
     * store user ticket reply
     *
     * @return void
     *
     */
    public function storeUserTicketReply()
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
        $userTickets = UserTicket::orderByDesc('created_at')->paginate(10);

        return view('livewire.back-end.ticket-list', compact('userTickets'))
            ->extends('backend.layouts.default')
            ->section('content');
    }
}
