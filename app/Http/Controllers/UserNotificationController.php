<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class UserNotificationController extends Controller
{
    public function fetch()
    {
        $user = Auth::user();
        return response()->json([
            'notifications' => $user->unreadNotifications
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();

        $notification = DatabaseNotification::where('id', $id)
            ->where('notifiable_id', $user->id)
            ->first();

        if ($notification) {
            $notification->delete();
        }

        return response()->json(['success' => true]);
    }
}
