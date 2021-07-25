<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class People extends Authenticatable
{
    use HasFactory;
    use Notifiable, HasApiTokens;

    protected $fillable = ['name','email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    //ownership of the conversation
    public function conversations(){
        return $this->hasMany(Conversation::class);
    }
}
