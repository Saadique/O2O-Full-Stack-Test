<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use App\Models\Message;
use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageOwner
{

    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $message = Message::findOrFail($request->route('message_id'));
        $person = Auth::user();

        if (Auth::guard('api')->check() && $message->person_id==$person->id) {
            return $next($request);
        } else {
            return $this->errorResponse("Permission Denied",401);
        }
    }
}
