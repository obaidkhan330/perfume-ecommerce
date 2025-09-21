<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class AdminNotificationController extends Controller
{
    /**
     * Fetch all unread notifications for admin
     */
  public function fetch() {
    return response()->json([
        'notifications' => Auth::user()->unreadNotifications
    ]);
}

    /**
     * Delete a specific notification
     */
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
