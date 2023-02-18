<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Traits\ApiResponse;
use App\Helpers\FileHelper;
class CampaignController extends Controller
{
    use ApiResponse;
    public function create(CampaignRequest $request)
    {
        $campaign = new Campaign([
            'brand_id' => $request->brand_id,
            'campaign_status' => Campaign::STATUS_APPLY,
        ]);
        $campaign->save();

        $campaignDetail = new CampaignDetail([
            'campaign_id' => $campaign->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'started_date' => $request->started_date,
            'ended_date' => $request->ended_date,
            'industry' => $request->industry,
            'hashtag' => $request->hashtag,
            'socialChannel' => $request->socialChannel,
            'amount' => $request->amount,
            'require' => $request->require,
            'interest' => $request->interest,
        ]);
        $campaignDetail->save();

        if ($request->hasfile('campaignImages')) {
            foreach ($request->file('campaignImages') as $file) {
                $campaignImage = FileHelper::uploadFileToS3($file, 'campaigns');
                $campaignImage->campaign_detail_id = $campaignDetail->id;
                $campaignImage->save();
            }
        }

        if ($request->hasfile('productImages')) {
            foreach ($request->file('productImages') as $file) {
                $productImage = FileHelper::uploadFileToS3($file, 'products');
                $productImage->campaign_detail_id = $campaignDetail->id;
                $productImage->save();
            }
        }

        return $this->responseSuccess();
    }

    public function update(CampaignRequest $request, $campaignId)
    {
        $campaign = Campaign::find($campaignId);
        if (empty($campaign)) {
            return $this->responseError('Campaign does not exist!');
        }

        $campaignDetail = CampaignDetail::where('campaign_id', $campaign->id)->first();
        $campaignDetail->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'started_date' => $request->started_date,
            'ended_date' => $request->ended_date,
            'industry' => $request->industry,
            'hashtag' => $request->hashtag,
            'socialChannel' => $request->socialChannel,
            'amount' => $request->amount,
            'require' => $request->require,
            'interest' => $request->interest,
        ]);

        $campaignDetailFiles = CampaignDetail::with('files')->findOrFail($campaignDetail->id);
        foreach ($campaignDetailFiles->files as $file) {
            FileHelper::removeFileFromS3($file);
            $file->delete();
        }

        if ($request->hasfile('campaignImages')) {
            foreach ($request->file('campaignImages') as $file) {
                $campaignImage = FileHelper::uploadFileToS3($file, 'campaigns');
                $campaignImage->campaign_detail_id = $campaignDetail->id;
                $campaignImage->save();
            }
        }

        if ($request->hasfile('productImages')) {
            foreach ($request->file('productImages') as $file) {
                $productImage = FileHelper::uploadFileToS3($file, 'products');
                $productImage->campaign_detail_id = $campaignDetail->id;
                $productImage->save();
            }
        }

        return $this->responseSuccess();
    }
    public function destroy($campaignId)
    {
        $campaign = Campaign::find($campaignId);
        if (empty($campaign)) {
            return $this->responseError('Campaign does not exist!');
        }

        $campaignDetails = CampaignDetail::with('files')->where('campaign_id', $campaign->id)->first();
        foreach ($campaignDetails->files as $file) {
            FileHelper::removeFileFromS3($file);
            $file->delete();
        }

        $campaignDetails->delete();
        $campaign->delete();

        return $this->responseSuccess();

        // social_infos
        // credential_id
        // type: ig, fb, titkok
        // url
    }

    public function viewDetailCampaign($campaign_id)
    {
    }
}
