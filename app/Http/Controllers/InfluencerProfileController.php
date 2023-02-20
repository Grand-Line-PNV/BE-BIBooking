<?php

namespace App\Http\Controllers;
use App\Http\Requests\InfluProfileRequest;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileHelper;

class InfluencerProfileController extends Controller
{    
    use ApiResponse;
    public function create(InfluProfileRequest $request,$account_id)
    {
        $userImage = FileHelper::uploadFileToS3($request->image,'influencers');
        $credential = new Credential([
            'account_id' => $account_id,
            'nickname' => $request->nickname,
            'dob' => $request->dob,
            'followers' => $request->followers,
            'bookingPrice' => $request->bookingPrice,
            'industry' => $request->industry,
            'marialStatus' => $request->marialStatus,
            'contentTopic' => $request->contentTopic,
            'startedWork' => $request->startedWork,
            'file_id'=> $userImage->id,     
        ]);
        $credential->save();
        DB::table('accounts')->where('id',$account_id)->update([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_line4' => $request->address_line4]
        );
        return $this->responseSuccess();
    }   
    public function view($account_id)
    {
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->join('files', 'files.id', '=', 'credentials.file_id')->where('account_id',$account_id)->get()->first();
        return $this->responseSuccessWithData($credential->toArray());
    }
    public function viewAccount($account_id)
        {
            $account = DB::table('accounts')->where('id',$account_id)->get();
            return $this->responseSuccessWithData($account->toArray());
        }  
}
