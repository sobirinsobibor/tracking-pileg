<?php

namespace App\Http\Controllers\admin_controllers;

use App\Models\VotingPlace;
use App\Models\ElectoralDistrict;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVotingPlaceRequest;
use App\Http\Requests\UpdateVotingPlaceRequest;

class VotingPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voting_places = VotingPlace::select([
            'voting_place_encrypted_id',
            'voting_place_name',
            'voting_place_address',
            'voting_place_sub_district',
            'voting_place_district',
            'voting_place_city',
            'voting_place_province',

            'electoral_districts.electoral_district_name',

        ])->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id' )
          ->get();

        return view('templating.admin-view.tps.index',[
            'voting_places' => $voting_places
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVotingPlaceRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(VotingPlace $votingPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VotingPlace $votingPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotingPlaceRequest $request, VotingPlace $votingPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VotingPlace $votingPlace)
    {
        //
    }
}
