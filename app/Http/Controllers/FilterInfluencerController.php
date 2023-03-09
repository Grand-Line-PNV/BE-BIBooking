<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Account;

class FilterInfluencerController extends Controller
{
    public function index(FilterRequest $request)
    {
        $influencers = Account::with('credential')
            ->where('role_id', Account::ROLE_INFLUENCER)
            ->keyword($request)
            ->whereHas('credential', function ($query) use ($request) {
                $query->gender($request)
                    ->job($request)
                    ->minCast($request)
                    ->maxCast($request)
                    ->keyword($request);
            });

        if (!$influencers->exists()) {
            return $this->commonResponse([], "There are no influencers that match your search", 404);
        }

        return $this->commonResponse($influencers->get());
    }
}
