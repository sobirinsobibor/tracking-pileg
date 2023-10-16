<?php

namespace App\Http\Controllers\user_controllers;

use App\Models\ElectoralDistrict;
use App\Http\Requests\StoreElectoralDistrictRequest;
use App\Http\Requests\UpdateElectoralDistrictRequest;
use App\Http\Controllers\Controller;

class ElectoralDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $electoral_districts = ElectoralDistrict::select([
            'electoral_district_encrypted_id',
            'electoral_district_name',
            'electoral_district_description',
            'created_at'
        ])->get();
        return view('templating.user-view.dapil.index',[
            'electoral_districts' => $electoral_districts
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
    public function store(StoreElectoralDistrictRequest $request)
    {
     
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectoralDistrict $electoralDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectoralDistrict $electoralDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateElectoralDistrictRequest $request, ElectoralDistrict $electoralDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectoralDistrict $electoralDistrict)
    {
        //
    }


}
