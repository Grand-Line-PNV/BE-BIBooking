<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProfileRequest;
use App\Helpers\FileHelper;
use App\Models\Credential;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class BrandProfileController extends Controller
{
    use ApiResponse;
    public function create(BrandProfileRequest $request)
    {
        $credential = new Credential(
            [
                'account_id' => $request->brand_id,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'address_line3' => $request->address_line3,
                'address_line4' => $request->address_line4,
                'nickname' => $request->brand_name,
                'dob' => $request->dob,
                'industry' => $request->industry,
                'website' => $request->website,
                'fullname' => $request->fullname,             
            ]
        );
        $credential->save();
        $brandImage = FileHelper::uploadFileToS3($request->image, 'brands');
        $brandImage->account_id = $credential->account_id;
        $brandImage->save();
        return $this->responseSuccess();
    }
    public function view($account_id)
    {
        $credential = DB::table('accounts')->join('credentials', 'accounts.id', '=', 'credentials.account_id')->join('files', 'files.id', '=', 'credentials.file_id')->where('account_id', $account_id)->get()->first();
        return $this->responseSuccessWithData($credential->toArray());
    }
    public function viewAccount($account_id)
    { {
            $account = DB::table('accounts')->where('id', $account_id)->get();
            return $this->responseSuccessWithData($account->toArray());
        }
    }
}
