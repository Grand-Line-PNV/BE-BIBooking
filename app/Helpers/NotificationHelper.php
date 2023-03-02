<?php

namespace App\Helpers;

use App\Models\Account;
use App\Models\Campaign;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationHelper
{
    public static function saveNotification($accountId, $content)
    {
        Notification::create([
            'account_id' => $accountId,
            'content' => $content,
            'sent_date' => Carbon::now(),
        ]);
    }
}