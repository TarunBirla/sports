<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false; // since no updated_at

    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
        'type',
        'created_at'
    ];

    // Chat relation
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // Sender (user or vendor)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}