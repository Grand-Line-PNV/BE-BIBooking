<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProfileRequest;

use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class BrandProfileController extends Controller
{    
    use ApiResponse;
    public function create(BrandProfileRequest $request,int $account_id)
    {
        $credential = new Credential([
            'account_id'=>$account_id,
            'industry' => $request->industry,
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
