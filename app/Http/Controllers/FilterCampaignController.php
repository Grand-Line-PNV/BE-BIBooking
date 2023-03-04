<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Campaign;

class FilterCampaignController extends Controller
{
    //search/filter by keyword, industry, minCast, maxCast
    public function index(FilterRequest $request)
    {
        $campaigns = Campaign::query()
        ->keyword($request)
        ->industry($request)
        ->minCast($request)
        ->maxCast($request);

        return $this->commonResponse($campaigns->get());
    }
}
