<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Account;
use App\Http\Resources\Address as AddressResource;
use App\Models\Credential;

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
        $ward = Ward::with(['district', 'district.province'])->firstWhere('code', $wardCode);
        $location = Credential::select(
                'address_line4 AS provinceCode',
                'address_line3 AS districtCode',
                'ward_code AS wardCode',
                'address_line1 AS houseNumber',
            )
            ->firstWhere([
                'account_id' => $userId,
                'ward_code' => $wardCode
            ]);

        $locationInDetail = implode(", ", [$location->houseNumber, $ward->full_name, $ward->district->full_name, $ward->district->province->full_name]);

        return new AddressResource([
            'locationInDetail' => $locationInDetail,
            'addressCodes' => $location,
        ]);
    }
}
