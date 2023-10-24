<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\SubDistrict;
use App\Models\VotingPlace;
use App\Models\ElectoralDistrict;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'voting_place_city',
            'voting_place_province',

            'sub_districts.sub_district_name',
            
            'districts.district_name',

            'electoral_districts.electoral_district_name',

        ])->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')
          ->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')
          ->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')
          ->get();

        return view('templating.super-admin-view.tps.index',[
            'voting_places' => $voting_places
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subDistricts = SubDistrict::select([
            'sub_districts.sub_district_encrypted_id',
            'sub_districts.sub_district_name',
            'districts.district_name'
            
        ])->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')
          ->get();
        $electoral_districts = ElectoralDistrict::select([
            'electoral_district_encrypted_id',
            'electoral_district_name',
            'electoral_district_description',
            'created_at'
        ])->get();
        return view('templating.super-admin-view.tps.create', [
            'electoral_districts' => $electoral_districts,
            'sub_districts' => $subDistricts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVotingPlaceRequest $request)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'voting_place_name' => 'required',
                'voting_place_address' => 'required|max:101',
                'voting_place_city' => 'required',
                'voting_place_province' => 'required',
                'id_electoral_district' => 'required',
                'id_sub_district' => 'required'
            ]);
            $validatedData['voting_place_artificial_id'] = $this->makeVotingPlaceAID($request->id_electoral_district);
            if(!$validatedData['voting_place_artificial_id']){
                return redirect('/dashboard/superadmin/tps/create')->with('message', ['text' => 'Error in Making ID (1)', 'class' => 'danger']);
            }
            $validatedData['voting_place_encrypted_id'] = $this->encrypted_id($validatedData['voting_place_artificial_id']);
            if(!$validatedData['voting_place_encrypted_id']){
                return redirect('/dashboard/superadmin/tps/create')->with('message', ['text' => 'Error in Making ID (2)', 'class' => 'danger']);
            }

            VotingPlace::create($validatedData);
            return redirect('/dashboard/superadmin/tps')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);
            
        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/tps/create')->with('message', ['text' => $e->getMessage() , 'class' => 'danger']);
        }
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
        'sub_districts.sub_district_name',
            
        'districts.district_name',
        'voting_places.voting_place_city',
        'voting_places.voting_place_province',
        'electoral_districts.electoral_district_name',
    ])
        ->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')
        ->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')
        ->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')
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
            return view('templating.super-admin-view.tps.detail', [
                'voting_places' => $combinedQuery,
                'datapertps' => $datapertps,
                'labelspartaipertps' => array_values($labelspartaipertps),
                'datapartaipertps' => array_values($datapartaipertps)
            ]);
        }else{
            return view('templating.super-admin-view.tps.detail',[
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

    protected function makeVotingPlaceAID($id_electoral_district){
        $count = VotingPlace::where('id_electoral_district', $id_electoral_district)->count();
        $id_electoral_district_format = ElectoralDistrict::select([
            'id' 
        ])->where('electoral_district_encrypted_id', $id_electoral_district) 
            ->first();
        
            // Menggunakan str_pad untuk menghasilkan format "001" dari $count
        $formattedCount = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Menggabungkan $formattedCount dan $id_electoral_district_format->id menjadi "001003"
        $formattedID = $formattedCount . str_pad($id_electoral_district_format->id, 3, '0', STR_PAD_LEFT);
        return $formattedID;

    }
}
