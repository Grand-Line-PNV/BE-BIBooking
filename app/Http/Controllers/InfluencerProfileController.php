<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfluProfileRequest;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileHelper;
use App\Http\Requests\AudienceRequest;
use App\Http\Requests\GenderRatioRequest;
use App\Http\Requests\ServicesRequest;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Requests\TopAgeRequest;
use App\Http\Requests\TopCityRequest;
use App\Models\Account;
use App\Models\AudienceData;
use App\Models\CityInfo;
use App\Models\GenderRatio;
use App\Models\Services;
use App\Models\SocialInfo;
use App\Models\TopAge;

class InfluencerProfileController extends Controller
{
    use ApiResponse;
    public function createInfluencerProfile(InfluProfileRequest $request)
    {
        $credential = new Credential([
            'account_id' => $request->account_id,
            'nickname' => $request->nickname,
            'fullname' => $request->fullname,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'job' => $request->job,
            'title_for_job' => $request->title_for_job,
            'description' => $request->description,
            'content_topic' => $request->content_topic,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_line4' => $request->address_line4,
        ]);
        $credential->save();

        if ($request->hasfile('influencerImages')) {
            foreach ($request->file('influencerImages') as $file) {
                $influencerImage = FileHelper::uploadFileToS3($file, 'influencers');
                $influencerImage->account_id = $request->account_id;
                $influencerImage->save();
            }
        }
        return $this->commonResponse($credential);
    }
    public function updateInfluencerProfile(InfluProfileRequest $request, $id)
    {
        $credential = Credential::where('account_id', $id)->first();
        if (empty($credential)) {
            return $this->responseError('Influencer does not exist!');
        }

        $credential->update([
            'nickname' => $request->nickname,
            'fullname' => $request->fullname,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'job' => $request->job,
            'title_for_job' => $request->title_for_job,
            'description' => $request->description,
            'content_topic' => $request->content_topic,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_line4' => $request->address_line4,
        ]);
        // $credential->save();
        $file = Account::with('files')->where('id', $id)->first();
        FileHelper::removeFileFromS3($file);
        $file->files()->delete();

        if ($request->hasfile('influencerImages')) {
            foreach ($request->file('influencerImages') as $file) {
                $influencerImage = FileHelper::uploadFileToS3($file, 'influencers');
                $influencerImage->account_id = $request->account_id;
                $influencerImage->save();
            }
        }

        return $this->responseSuccess();
    }
    public function createSocialMediaData(SocialMediaRequest $request)
    {
        $socials = $request->get('socials');
        foreach ($socials as $social) {
            $account = Account::firstWhere(['id' => $social['account_id'], 'role_id' => Account::ROLE_INFLUENCER]);
            if (empty($account)) {
                return $this->responseError('User does not exist!');
            }

            SocialInfo::create([
                'account_id' => $social["account_id"],
                'name' => $social["name"],
                'username' => $social["username"],
                'fullname' => $social["fullname"],
                'avg_interactions' => $social["avg_interactions"],
                'subcribers' => $social["subcribers"],
                'link' => $social["link"],
            ]);
        }

        return $this->responseSuccess();
    }

    public function updateSocialMeidaData(SocialMediaRequest $request, $userId)
    {
        $account = Account::firstWhere(['id' => $userId, 'role_id' => Account::ROLE_INFLUENCER]);
        if (empty($account)) {
            return $this->responseError('User does not exist!');
        }

        $socials = $request->get('socials');
        foreach ($socials as $socialData) {
            $social = SocialInfo::firstWhere(['id' => $socialData['social_id'], 'account_id' => $userId]);
            if (empty($social)) {
                return $this->responseError('Social info does not exist!');
            }

            $social->update([
                'name' => $socialData["name"],
                'username' => $socialData["username"],
                'fullname' => $socialData["fullname"],
                'avg_interactions' => $socialData["avg_interactions"],
                'subcribers' => $socialData["subcribers"],
                'link' => $socialData["link"],
            ]);
        }

        return $this->responseSuccess();
    }


    public function createAudienceData(AudienceRequest $request)
    {
        if (($request->male + $request->female + $request->others) == 100) {
            if (($request->age1 + $request->age2 + $request->age3 + $request->age4) == 100) {
                if (($request->city1 + $request->city2 + $request->city3 + $request->city4) == 100) {
                    $audienceData = new AudienceData([
                        'account_id' => $request->account_id,
                        'male' => $request->male,
                        'female' => $request->female,
                        'others' => $request->others,
                        'age1' => $request->age1,
                        'age2' => $request->age2,
                        'age3' => $request->age3,
                        'age4' => $request->age4,
                        'city1' => $request->city1,
                        'city2' => $request->city2,
                        'city3' => $request->city3,
                        'city4' => $request->city4,
                    ]);
                } else {
                    return $this->responseError('Total city percentage must be 100%');
                }
            } else {
                return $this->responseError('Total age percentage must be 100%');
            }
        } else {
            return $this->responseError('Total gender percentage must be 100%');
        }

        $audienceData->save();
        return $this->responseSuccess();
    }
    public function updateAudience(AudienceRequest $request, $userId)
    {
        $audienceData = AudienceData::where('account_id', $userId)->first();
        if (empty($audienceData)) {
            return $this->responseError('Influencer does not exist!');
        }
        if (($request->male + $request->female + $request->others) == 100) {
            if (($request->age1 + $request->age2 + $request->age3 + $request->age4) == 100) {
                if (($request->city1 + $request->city2 + $request->city3 + $request->city4) == 100) {
                    $audienceData->update([
                        'male' => $request->male,
                        'female' => $request->female,
                        'others' => $request->others,
                        'age1' => $request->age1,
                        'age2' => $request->age2,
                        'age3' => $request->age3,
                        'age4' => $request->age4,
                        'city1' => $request->city1,
                        'city2' => $request->city2,
                        'city3' => $request->city3,
                        'city4' => $request->city4,
                    ]);
                } else {
                    return $this->responseError('Total city percentage must be 100%');
                }
            } else {
                return $this->responseError('Total age percentage must be 100%');
            }
        } else {
            return $this->responseError('Total gender percentage must be 100%');
        }

        return $this->responseSuccess();
    }

    public function createServices(ServicesRequest $request)
    {
        $services = $request->get('services');


        foreach ($services as $service) {
            $account = Account::firstWhere(['id' => $service['account_id'], 'role_id' => Account::ROLE_INFLUENCER]);
            if (empty($account)) {
                return $this->responseError('User does not exist!');
            }
            Services::create([
                'account_id' => $service["account_id"],
                'name' => $service["name"],
                'description' => $service["description"],

            ]);
        }
        return $this->responseSuccess();
    }
    public function updateServices(ServicesRequest $request, $userId)
    {
        $account = Account::firstWhere(['id' => $userId, 'role_id' => Account::ROLE_INFLUENCER]);
        if (empty($account)) {
            return $this->responseError('User does not exist!');
        }

        $services = $request->get('services');
        foreach ($services as $serviceData) {
            $service = Services::firstWhere(['id' => $serviceData['service_id'], 'account_id' => $userId]);
            if (empty($service)) {
                return $this->responseError('Service info does not exist!');
            }

            $service->update([
                'name' => $serviceData["name"],
                'description' => $serviceData["description"],

            ]);
        }

        return $this->responseSuccess();
    }

    public function view($account_id)
    {
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->join('files', 'files.id', '=', 'credentials.file_id')->where('account_id', $account_id)->get()->first();
        return $this->responseSuccessWithData($credential->toArray());
    }

    public function viewAccount($account_id)
    {
        $account = DB::table('accounts')->where('id', $account_id)->get();
        return $this->responseSuccessWithData($account->toArray());
    }
}
