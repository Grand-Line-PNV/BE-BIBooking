<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProfileRequest;
use App\Helpers\FileHelper;
use App\Models\Account;
use App\Models\Credential;
use App\Traits\ApiResponse;

class BrandProfileController extends Controller
{
    use ApiResponse;
    public function create(BrandProfileRequest $request)
    {
        $credential = Credential::create(
            [
                'account_id' => $request->account_id,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'address_line3' => $request->address_line3,
                'address_line4' => $request->address_line4,
                'ward_code' => $request->ward_code,
                'nickname' => $request->nickname,
                'dob' => $request->dob,
                'industry' => $request->industry,
                'website' => $request->website,
                'fullname' => $request->fullname,
                'description' => $request->description,
                'brand_name' => $request->brand_name,
            ]
        );

        $brandImage = FileHelper::uploadFileToS3($request->image, 'brands');
        $brandImage->account_id = $credential->account_id;
        $brandImage->save();

        return $this->responseSuccess();
    }
    public function update(BrandProfileRequest $request, $id)
    {
        $credential = Credential::where('account_id', $id)->first();
        if (empty($credential)) {
            return $this->commonResponse([], "Brand does not exist!", 404);
        }

        $credential->update([
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_line4' => $request->address_line4,
            'ward_code' => $request->ward_code,
            'nickname' => $request->nickname,
            'dob' => $request->dob,
            'industry' => $request->industry,
            'website' => $request->website,
            'fullname' => $request->fullname,
            'description' => $request->description,
            'brand_name' => $request->brand_name,
        ]);
        
        $file = Account::with('files')->where('id', $id)->first();
        FileHelper::removeFileFromS3($file);
        $file->files()->delete();

        $brandImage = FileHelper::uploadFileToS3($request->image, 'brands');
        $brandImage->account_id = $credential->account_id;
        $brandImage->save();
        
        return $this->responseSuccess();
    }

    public function view($id)
    {
        $credential = Account::with('credential', 'files')->where('id', $id)->first();
        return $this->commonResponse($credential);
    }

    public function delete($id)
    {
        Credential::where('account_id', $id)->delete();
        $file = Account::with('files')->where('id', $id)->first();
        FileHelper::removeFileFromS3($file);
        $file->files()->delete();
        return $this->commonResponse([], "Credential has deleted success.");
    }
}
