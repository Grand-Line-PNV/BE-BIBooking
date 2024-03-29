<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use App\Helpers\NotificationHelper;
use App\Events\BookingNotifications;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    public function commonResponse($data, $message = "", $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // public function sendNotification($consumerId, $msgContent) {
    //     NotificationHelper::saveNotification($consumerId, $msgContent);
    //     event(new BookingNotifications([
    //         'time' => Carbon::now(),
    //         'message' => $msgContent,
    //         'userId' => $consumerId,
    //     ]));
    // }

    public function sendNotification($consumerId, $msgContent) {
        NotificationHelper::saveNotification($consumerId, $msgContent);

        try {
            event(new BookingNotifications([
                'time' => Carbon::now(),
                'message' => $msgContent,
                'userId' => $consumerId,
            ]));
        } catch (\Throwable $th) {
            Log::error('Error QRcode event: ' . $th->getMessage());
        }
        
    }
}
