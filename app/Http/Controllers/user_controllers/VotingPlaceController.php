<?php

namespace App\Http\Controllers\user_controllers;

use App\Models\VotingPlace;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVotingPlaceRequest;
use App\Http\Requests\UpdateVotingPlaceRequest;
use App\Models\DetailLocationOfVotingPlace;

class VotingPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DetailLocationOfVotingPlace = DetailLocationOfVotingPlace::select([
            'voting_places.voting_place_encrypted_id',
            'voting_places.voting_place_name',
            'voting_places.voting_place_address',
            'sub_districts.sub_district_name',
            
            'districts.district_name',


            'voting_places.voting_place_city',
            'voting_places.voting_place_province',

            'electoral_districts.electoral_district_name',
            'electoral_districts.electoral_district_description',
        ])
        ->join('voting_places', 'detail_location_of_voting_places.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
        ->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id' )
        ->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')
        ->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')

        ->where('detail_location_of_voting_places.id_user', Auth::user()->id)
        ->first();

        return view('templating.user-view.tps.index',[
            'DetailLocationOfVotingPlace' => $DetailLocationOfVotingPlace
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
