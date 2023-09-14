<?php

namespace App\View\Components;

use Closure;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component

{
    public $notifications;
    public $unreadCount;

    /**
     * Create a new component instance.
     */



    public function __construct()
    {
        if (Auth::check()) {

            $user = Auth::user();

            $notifications = $user->notifications()->take(10)->get();

            $this->unreadCount = $user->unreadNotifications()->count();
            $this->notifications = $notifications;
        }

        }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notifications-menu',[
//            'notifications'=>$this->notifications, م في داعي ارسلها لانها فوق معرفة ببليك
        ]);
    }
}
