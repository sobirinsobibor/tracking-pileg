<?php

namespace App\Http\Controllers\super_admin_controllers;

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
        return view('templating.super-admin-view.dapil.index',[
            'electoral_districts' => $electoral_districts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('templating.super-admin-view.dapil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElectoralDistrictRequest $request)
    {
        try{
            $artificial_id = $this->makeElectoralDistrictAID();
            $validatedData = $request->validate([
                'electoral_district_name' => 'required',
                'electoral_district_description' => 'required|max:201'
            ]);
            $validatedData['electoral_district_artificial_id'] = $artificial_id;
            $validatedData['electoral_district_encrypted_id'] = $this->encrypted_id($artificial_id);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            ElectoralDistrict::create($validatedData);
            return redirect('/dashboard/superadmin/dapil')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/dapil/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
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

    protected function makeElectoralDistrictAID(){
        $count = ElectoralDistrict::count();

        // Menggunakan str_pad untuk menghasilkan format "001"
        $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);

        return $formattedCount;
    }

}
