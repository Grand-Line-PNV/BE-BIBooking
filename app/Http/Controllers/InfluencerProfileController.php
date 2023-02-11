<?php

namespace App\Http\Controllers;
use App\Http\Requests\InfluProfileRequest;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class InfluencerProfileController extends Controller
{    
    use ApiResponse;
    public function create(InfluProfileRequest $request)
    {
        $credential = new Credential([
            'account_id' => $request->account_id,
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
            'website'=>'',
            'brandName'=>''
        ]);
        // $credential->save();
        // DB::table('credential')->where('account_id',4)->insert([
        //     ['nickname' => $request->nickname],
        //     ['dob' => $request->dob],
        //     ['followers' => $request->followers],
        //     ['bookingPrice' => $request->bookingPrice],
        //     ['industry' => $request->industry],
        //     ['marialStatus' => $request->marialStatus],
        //     ['contentTopic' => $request->contentTopic],
        //     ['startedWork' => $request->startedWork],
        //     ['link'=>$request->link],
        //     [ 'file_id'=> $request->file_id],
        //     ['website'=>''],
        //     ['brandName'=>'']
        // ])
        ;
        return $this->responseSuccess();
    }
    public function view($account_id)
    {
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->where('account_id',$account_id)->get();
        return $credential;
    }
}
