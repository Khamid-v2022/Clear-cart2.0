<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewChatTable extends Migration
{
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id')->nullable();
            $table->unsignedInteger('sender_id')->nullable();
            $table->unsignedInteger('receiver_id')->nullable();
            $table->longText('message')->nullable();
            $table->date("message_date")->nullable();
            $table->boolean('sender_read')->default(0);
            $table->boolean('receiver_read')->default(0);
            $table->string('type')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sender_id')
                ->references('id')
                ->on('users');

            $table->foreign('receiver_id')
                ->references('id')
                ->on('users');

            $table->foreign('ticket_id')
                ->references('id')
                ->on('users_tickets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}