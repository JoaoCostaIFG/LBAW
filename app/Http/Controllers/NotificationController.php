<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function delete(Request $request)
    {
        $to_delete = Notification::find($request->id);
        $this->authorize('delete', $to_delete);
        $to_delete->delete();

        return back();
    }
}
