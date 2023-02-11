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
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->where('account_id',$account_id)->get();
        return $credential;
    }
}
