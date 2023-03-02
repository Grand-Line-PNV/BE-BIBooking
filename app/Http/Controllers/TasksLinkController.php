<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksLinkRequest;
use App\Models\Booking;
use App\Models\TasksLink;
use Carbon\Carbon;
use App\Helpers\NotificationHelper;
use App\Events\BookingActions;
use App\Events\BookingNotifications;
use App\Models\Account;
use App\Models\Campaign;

class TasksLinkController extends Controller
{
    public function store(TasksLinkRequest $request)
    {
        $tasksLink = TasksLink::create([
            'booking_id' => $request->booking_id,
            'link' => $request->link,
            'description' => $request->description,
            'submitted_date' => Carbon::now(),
        ]);

        $booking = Booking::find($tasksLink->booking_id);
        $booking->update([
            'status' => Booking::STATUS_DONE,
        ]);

        //send email and notification - done rui
        event(new BookingActions($booking));

        $influencer = Account::find($booking->influencer_id);
        $campaign = Campaign::find($booking->campaign_id);


        $influencerNotifyContent = 'Hi @' . $influencer->username . ', your booking is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($influencer->id, $influencerNotifyContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $influencerNotifyContent,
            'userId' => $influencer->id,
        ]));

        $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        $brandContent = 'Hi @' . $brand->username . ', your campaign has been booked by @' . $influencer->username . ' and it is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($brand->id, $brandContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $brandContent,
            'userId' => $brand->id,
        ]));


        return $this->commonResponse($tasksLink);
    }
    public function edit(TasksLinkRequest $request,$id)
    {
        $tasksLink = TasksLink::findOrFail($id);

        $tasksLink -> update([
            'link' => $request->link,
            'description' => $request->description,
            'submitted_date' => Carbon::now(),
        ]);

        return $this->commonResponse($tasksLink);
    }

    public function destroy($id)
    {
        $tasksLink = TasksLink::findOrFail($id);

        $tasksLink -> delete();

        $this->commonResponse([], "Task has been deleted success.");
    }
}
