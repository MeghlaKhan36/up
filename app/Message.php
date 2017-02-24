<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['subject', 'sender_id', 'receiver_id', 'file_id', 'message', 'sender_deleted', 'receiver_deleted'];

    public function User()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }
}
