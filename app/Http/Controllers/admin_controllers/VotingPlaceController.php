<?php

namespace App\Http\Controllers\admin_controllers;

use App\Models\VotingPlace;
use App\Models\ElectoralDistrict;
use Illuminate\Support\Facades\DB;
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
    public function show($id_voting_place)
    {
                //identitas tps
                $combinedQuery = VotingPlace::select([
                    'voting_places.voting_place_encrypted_id',
                    'voting_places.voting_place_name',
                    'voting_places.voting_place_address',
                    'voting_places.voting_place_sub_district',
                    'voting_places.voting_place_district',
                    'voting_places.voting_place_city',
                    'voting_places.voting_place_province',
                    'electoral_districts.electoral_district_name',
                ])
                    ->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')
                    ->where('voting_places.voting_place_encrypted_id', '=', $id_voting_place)
                    ->first();
            
                    //data suara
                    $candidatevotestps = DB::table('candidate_votes')->select(
                        'candidate_votes.candidate_vote_vote_count', 
                        'voting_places.voting_place_name'
                    )->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                     ->join('detail_location_of_voting_places', 'detail_location_of_voting_places.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                     ->where('detail_location_of_voting_places.id_voting_place', '=', $id_voting_place)
                     ->first();
            
                    $partyvotestps = DB::table('total_votes')->select(
                        'total_votes.total_vote_vote_count', 
                        'parties.party_name'
                    )->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')
                     ->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                     ->join('detail_location_of_voting_places', 'detail_location_of_voting_places.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                     ->where('detail_location_of_voting_places.id_voting_place', '=', $id_voting_place)
                     ->get();
            
                    if($candidatevotestps && $partyvotestps){ //kalo ada (sudah ngumpulin)
                        $labelspartaipertps = [];
                        $datapartaipertps = [];
                
                        $datapertps = (int)$candidatevotestps->candidate_vote_vote_count;
                
                        foreach ($partyvotestps as $partaitpsdata) {
                            $labelspartaipertps[] = $partaitpsdata->party_name;
                            $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
                        }
                        return view('templating.admin-view.tps.detail', [
                            'voting_places' => $combinedQuery,
                            'datapertps' => $datapertps,
                            'labelspartaipertps' => array_values($labelspartaipertps),
                            'datapartaipertps' => array_values($datapartaipertps)
                        ]);
                    }else{
                        return view('templating.admin-view.tps.detail',[
                            'voting_places' => $combinedQuery
                        ]);
                    }
            
            
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
