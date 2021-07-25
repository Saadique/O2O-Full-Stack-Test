<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationOwner
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
        $conversation = Conversation::findOrFail($request->route('conversation_id'));
        $person = Auth::user();
        if (Auth::guard('api')->check() && $person->id==$conversation->owner_id) {
            return $next($request);
        } else {
            return $this->errorResponse("Permission Denied",401);
        }
    }
}
