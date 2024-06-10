<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function count()
    {
        // Assuming you have a notifications table and a model named Notification
        $user = Auth::user();
        $unreadCount = $user->notifications()->where('read_at', null)->count();

        return response()->json(['count' => $unreadCount]);
    }
}
