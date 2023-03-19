<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Account;
use App\Models\Booking;
use App\Models\Campaign;
use App\Models\Feedback;


class FeedbackController extends Controller
{
    public function store(FeedbackRequest $request)
    {
        $account = Account::find($request->account_id);
        if (empty($account)) {
            return $this->commonResponse([], "Account does not exist!", 404);
        };
        $feedback = Feedback::create([
            'booking_id' => $request->booking_id,
            'from_type' => $account->role_id,
            'from_account_id' => $request->account_id,
            'content' => $request->content,
        ]);

        //send notifications for brand/influencer 

        $booking = Booking::find($feedback->booking_id);
            if (empty($booking)) {
                return $this->commonResponse([], "Booking does not exist!", 404);
            };

        $influencer = Account::find($booking->influencer_id);
            if (empty($booking)) {
                return $this->commonResponse([], "Influencer does not exist!", 404);
            };

        $campaign = Campaign::find($booking->campaign_id);
            if (empty($booking)) {
                return $this->commonResponse([], "Campaign does not exist!", 404);
            };

        if ($feedback->from_type == Account::ROLE_BRAND) {
            $influencerNotifyContent = 'Hi @' . $influencer->username . ', you have just received a feedback from brand for booking with the ID #' . $booking->id . ' state now!';
            $this->sendNotification($influencer->id, $influencerNotifyContent);
        } else {
            $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
            $brandNotifyContent = 'Hi @' . $brand->username . ', you have just received a feedback from influencer for booking with the ID #' . $booking->id . ' state now!';
            $this->sendNotification($brand->id, $brandNotifyContent);
        }

        return $this->commonResponse($feedback);
    }

    public function edit(FeedbackRequest $request, $id)
    {
        $feedback = Feedback::find($id);
        if (empty($feedback)) {
            return $this->commonResponse([], "Feedback does not exist!", 404);
        }
        $feedback->update([
            'content' => $request->content,
        ]);

        return $this->commonResponse($feedback);
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (empty($feedback)) {
            return $this->commonResponse([], "Feedback does not exist!", 404);
        }
        $feedback->delete();

        return $this->commonResponse([], "Feedback has deleted successfully.");
    }
}
