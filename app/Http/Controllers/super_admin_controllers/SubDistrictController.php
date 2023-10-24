<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\District;
use App\Models\SubDistrict;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubDistrictRequest;
use App\Http\Requests\UpdateSubDistrictRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

class SubDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subDistricts = SubDistrict::select([
            'sub_districts.sub_district_name',
            'districts.district_name'
        ])->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')
          ->get();
        return view('templating.super-admin-view.desa.index',[
            'sub_districts' => $subDistricts
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::select([
            'district_name',
            'district_encrypted_id'
        ])->get();

        return view('templating.super-admin-view.desa.create',[
            'districts' => $districts
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubDistrictRequest $request)
    {
        // dd($request);
        try{
    
            $validatedData = $request->validate([
                'sub_district_name' => 'required',
                'id_district' => 'required',
            ]);
            $artificial_id = $this->makeSubDistrictAID($request->id_district);
            $validatedData['sub_district_artificial_id'] = $artificial_id;
            $validatedData['sub_district_encrypted_id'] = $this->encrypted_id($artificial_id);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            // dd($validatedData);

            SubDistrict::create($validatedData);

            return redirect('/dashboard/superadmin/desa')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/desa/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubDistrictRequest $request, SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubDistrict $subDistrict)
    {
        //
    }

    protected function makeSubDistrictAID($id_district){
        $count = SubDistrict::where('id_district', $id_district)->count();
        $id_district_format = District::select([
            'id' 
        ])->where('district_encrypted_id', $id_district) 
            ->first();
        
            // Menggunakan str_pad untuk menghasilkan format "001" dari $count
        $formattedCount = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Menggabungkan $formattedCount dan $id_electoral_district_format->id menjadi "001003"
        $formattedID = $formattedCount . str_pad($id_district_format->id, 3, '0', STR_PAD_LEFT);
        return $formattedID;

    }

}
