<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Credential;

class FilterInfluencerController extends Controller
{
    public function index(FilterRequest $request)
    {
        $influecers = Account::query()
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ->job($request)
            ->gender($request)
            ->minCast($request)
            ->maxCast($request)
            ->where('role_id',Account::ROLE_INFLUENCER);
        // if (empty($campaigns)) {
        //     return $this->commonResponse([], "Campain does not exist.", 404);
        // }
        return $this->commonResponse($influecers->get());
    }
}
                                                                                                                                                                            