<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Account;
use App\Http\Resources\Address as AddressResource;

class AddressController extends Controller
{
    public function loadProvince()
    {
        $districts = Province::select('code', 'full_name AS name')->get();

        return new AddressResource($districts);
    }

    public function loadDistrict(string $code)
    {
        $districts = District::select('code', 'full_name AS name')->where('province_code', '=', $code)->get();

        return new AddressResource($districts);
    }

    public function loadWard(string $code)
    {
        $wards = Ward::select('code', 'full_name AS name')->where('district_code', '=', $code)->get();

        return new AddressResource($wards);
    }

    public function loadUserLocation(int $userId, string $wardCode)
    {
        $ward = Ward::where('code', '=', $wardCode)->first();
        $district = District::where('code', '=', $ward->district_code)->first();
        $province = Province::where('code', '=', $district->province_code)->first();

        $location = Account::select(
            'address_line4 AS provinceCode',
            'address_line3 AS districtCode',
            'address_line2 AS wardCode',
            'address_line1 AS houseNumber',
        )->where([
            'id' => $userId,
            'address_line2' => $wardCode
        ])->first();
    
        $locationInDetail = implode(", ", [$location->houseNumber, $ward->full_name, $district->full_name, $province->full_name]);
        
        return new AddressResource([
            'locationInDetail' => $locationInDetail,
            'addressCodes' => $location,
        ]);
    }
}
