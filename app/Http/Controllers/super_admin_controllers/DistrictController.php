<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\District;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::select([
            'district_name',
        ])->get();
        
        return view('templating.super-admin-view.kecamatan.index',[
            'districts' => $districts
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('templating.super-admin-view.kecamatan.create',[
            // 'parties' => $parties
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request)
    {
        // dd($request);
        try{
            $artificial_id = $this->makeDistrictAID();
    
            $validatedData = $request->validate([
                'district_name' => 'required',
            ]);
            $validatedData['district_artificial_id'] = $artificial_id;
            $validatedData['district_encrypted_id'] = $this->encrypted_id($artificial_id);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            District::create($validatedData);

            return redirect('/dashboard/superadmin/kecamatan')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/kecamatan/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }

    protected function makeDistrictAID(){
        $count = District::count();

        // Menggunakan str_pad untuk menghasilkan format "001"
        $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);

        return $formattedCount;
    }

}
