<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $timeStamps = true;

    /**
     * user ticket
     *
     * @return void
     *
     */
    public function userTicket()
    {
        return $this->belongsTo(UserTicket::class, 'ticket_id');
    }
}
