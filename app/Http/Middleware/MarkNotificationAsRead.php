<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notify_id =$request->query('notify_id');
        if($notify_id && Auth::check()){
            $user=Auth::user();
            $notifcation = $user->notifications()->find($notify_id);
            if($notifcation && $notifcation->unread()){
                $notifcation->markAsRead();
            }
        }
        return $next($request);
    }
}
