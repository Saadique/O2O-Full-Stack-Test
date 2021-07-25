<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['person_id','conversation_id', 'body'];

    public function person(){
        return $this->belongsTo(People::class);
    }

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}
