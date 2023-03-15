<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Account;

class FilterInfluencerController extends Controller
{
    public function index(FilterRequest $request)
    {
        
        if (!($request->has('keyword') and ($request->has('keyword')) and ($request->has('keyword')) and ($request->has('keyword')) and ($request->has('keyword'))))
        {
            $influencers = Account::with('credential')
            ->has('credential')
            ->where('role_id', Account::ROLE_INFLUENCER);
            return $this->commonResponse($influencers->get());
        }
        $influencers = Account::with('credential')
            ->has('credential')
            ->where('role_id', Account::ROLE_INFLUENCER)
            ->keyword($request) 
            ->credential($request);

        if (!$influencers->exists()) {
            return $this->commonResponse([], "There are no influencers that match your search", 404);
        }

        return $this->commonResponse($influencers->get());
    }
}
