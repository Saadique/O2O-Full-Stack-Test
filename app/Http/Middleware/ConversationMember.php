<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConversationMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $conversation = Conversation::findOrFail($request->route('conversation_id'));
        $person = Auth::user();
        $isAParticipant = DB::select("SELECT * FROM participants WHERE
                                 person_id=$person->id AND conversation_id=$conversation->id");

        if (Auth::guard('api')->check() && $isAParticipant) {
            return $next($request);
        } else {
            return $this->errorResponse("Permission Denied",401);
        }
    }
}
