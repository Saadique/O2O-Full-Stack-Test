<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['title','owner_id'];

    //ownership of the conversation
    public function people(){
        return $this->belongsTo(People::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
