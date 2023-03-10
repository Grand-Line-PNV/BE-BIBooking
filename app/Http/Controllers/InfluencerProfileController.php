<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfluProfileRequest;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileHelper;
use App\Http\Requests\GenderRatioRequest;
use App\Http\Requests\ServicesRequest;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Requests\TopAgeRequest;
use App\Http\Requests\TopCityRequest;
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

    public function createSocialMediaData(SocialMediaRequest $request)
    {
        $socials = $request->get('socials');
        foreach ($socials as $socical) {
            SocialInfo::create([
                'account_id' => $socical["account_id"],
                'name' => $socical["name"],
                'username' => $socical["username"],
                'fullname' => $socical["fullname"],
                'avg_interactions' => $socical["avg_interactions"],
                'subcribers' => $socical["subcribers"],
                'link' => $socical["link"],
            ]);
        }

        return $this->responseSuccess();
    }

    public function createGenderRatio(GenderRatioRequest $request)
    {
        $topGenderRatio = new GenderRatio([
            'account_id' => $request->account_id,
            'male' => $request->male,
            'female' => $request->female,
            'others' => $request->others
        ]);
        $topGenderRatio->save();
        $topAge = new TopAge([
            'account_id' => $request->account_id,
            'level1' => $request->level1,
            'level2' => $request->level2,
            'level3' => $request->level3,
            'others' => $request->others
        ]);
        $topAge->save();
        $topCity = new CityInfo([
            'account_id' => $request->account_id,
            'city1' => $request->city1,
            'city2' => $request->city2,
            'city3' => $request->city3,
            'others' => $request->others,
        ]);
        $topCity->save();
        return $this->responseSuccess();
    }


    public function createServices(ServicesRequest $request)
    {
        $services = $request->get('services');
        foreach ($services as $service) {
            Services::create([
                'account_id' => $service["account_id"],
                'name' => $service["name"],
                'description' => $service["description"],
                
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
