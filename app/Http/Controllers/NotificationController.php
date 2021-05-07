<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\NotificationAchievement;

class NotificationController extends Controller
{
    public function delete(Request $request)
    {
        $to_delete = Notification::find($request->id);
        $this->authorize('delete', $to_delete);

        $child_notification = $to_delete->notification_achievement;
        if (is_null($child_notification)) {
            $child_notification = $to_delete->notification_post;
        }

        $child_notification->delete();

        return redirect()->back();
    }
}
