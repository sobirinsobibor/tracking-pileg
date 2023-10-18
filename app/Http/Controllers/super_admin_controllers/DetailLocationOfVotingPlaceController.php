<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\User;
use App\Models\VotingPlace;
use App\Http\Controllers\Controller;
use App\Models\DetailLocationOfVotingPlace;
use App\Http\Requests\StoreDetailLocationOfVotingPlaceRequest;
use App\Http\Requests\UpdateDetailLocationOfVotingPlaceRequest;

class DetailLocationOfVotingPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select([
            'id',
            'name',
            'nik',
            'email',
            'telephone',
            'address',
            'email',
        ])->where('id_role', '=', 3)
          ->get();

        return view('templating.super-admin-view.pemetaan-petugas.index', [
            'users' => $users  
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetailLocationOfVotingPlaceRequest $request)
    {
        try{
            $validatedData = $request->validate([
                'id_voting_place' => 'required',
                'id_user' => 'required'
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            DetailLocationOfVotingPlace::create($validatedData);
            return redirect('/dashboard/superadmin/pemetaan-petugas')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/pemetaan-petugas/'.$request->id_user.'/edit')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailLocationOfVotingPlace $detailLocationOfVotingPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $user = User::findOrFail($id);
            if($user->id_role !== 3){
                return redirect('/dashboard/superadmin/pemetaan-petugas')->with('message', ['text' => 'Tidak Memiliki Akses Untuk Melanjutkan ', 'class' => 'warning']);
            }

            $isRegisteredToTPS = DetailLocationOfVotingPlace::where('id_user', $user->id)->first();   
            if($isRegisteredToTPS !== null ){ //kalo ada
                $voting_place = $isRegisteredToTPS->id_voting_place;
                $voting_places = VotingPlace::select([
                    'voting_place_encrypted_id',
                    'voting_place_name',
                    'voting_place_address',
                    'voting_place_sub_district',
                    'voting_place_district',
                    'voting_place_city',
                    'voting_place_province',
        
                    'electoral_districts.electoral_district_name',
        
                ])->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')
                  ->where('voting_places.voting_place_encrypted_id', '=', $voting_place)
                  ->first();
            }else{
                $voting_places = VotingPlace::select([
                    'voting_place_encrypted_id',
                    'voting_place_name',
        
                    'electoral_districts.electoral_district_name',
        
                ])->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id' )
                  ->get();
            }
            
            return view('templating.super-admin-view.pemetaan-petugas.edit',[
                'user'=>$user,
                'voting_places'=>$voting_places
            ]);
        }catch(\Exception $e){

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailLocationOfVotingPlaceRequest $request, DetailLocationOfVotingPlace $detailLocationOfVotingPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailLocationOfVotingPlace $detailLocationOfVotingPlace)
    {
        //
    }
}
