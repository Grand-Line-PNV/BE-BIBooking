<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProfileRequest;

use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class BrandProfileController extends Controller
{    
    use ApiResponse;
    public function create(BrandProfileRequest $request,)
    {
        $credential = new Credential([
            'account_id'=>$request->account_id,
            'nickname' => '',
            'dob' => '2002-5-2',
            'followers' => 0,
            'bookingPrice' => 0,
            'industry' => $request->industry,
            'marialStatus' => 'single',
            'contentTopic' => '',
            'startedWork' => '2002-5-2',
            'link'=>$request->link,
            'file_id'=> $request->file_id,
            'brandName'=>$request->brandName,
            'website'=>$request->website
        ]);
        $credential->save();
        return $this->responseSuccess();
    }
    public function view($account_id)
    {
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->where('account_id',$account_id)->get();
        return $credential;
    }
}
