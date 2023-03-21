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

        $influencerNotifyContent = 'Hi @' . $influencer->username . ', your booking is in the #' . $booking->status . ' state now!';
        $this->sendNotification($influencer->id, $influencerNotifyContent);

        $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        $brandNotifyContent = 'Hi @' . $brand->username . ', your campaign has been booked by @' . $influencer->username . ' and it is in the #' . $booking->status . ' state now!';
        $this->sendNotification($brand->id, $brandNotifyContent);

        return $this->commonResponse($tasksLink);
    }
    public function edit(TasksLinkRequest $request, $id)
    {
        $tasksLink = TasksLink::find($id);
        if (empty($tasksLink)) {
            return $this->commonResponse([], "Task Link does not exist!", 404);
        }
        $tasksLink->update([
            'link' => $request->link,
            'description' => $request->description,
            'submitted_date' => Carbon::now(),
        ]);

        return $this->commonResponse($tasksLink);
    }

    public function destroy($id)
    {
        $tasksLink = TasksLink::find($id);
        if (empty($tasksLink)) {
            return $this->commonResponse([], "Task Link does not exist!", 404);
        }

        $tasksLink->delete();

        $this->commonResponse([], "Task has been deleted success.");
    }
}
