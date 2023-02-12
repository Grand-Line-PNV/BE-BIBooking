<?php

namespace App\Http\Controllers;
use App\Http\Requests\InfluProfileRequest;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class InfluencerProfileController extends Controller
{    
    use ApiResponse;
    public function create(InfluProfileRequest $request,$account_id)
    {
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
            'link'=>$request->link,
            'file_id'=> $request->file_id,
            
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
    public function viewAccount($account_id)
        {
            return DB::table('accounts')->where('account_id',$account_id)->get();
        }
    
}
