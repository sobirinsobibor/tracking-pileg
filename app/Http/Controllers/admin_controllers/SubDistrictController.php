<?php

namespace App\Http\Controllers\admin_controllers;

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
        return view('templating.admin-view.desa.index',[
            'sub_districts' => $subDistricts
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
    public function store(StoreSubDistrictRequest $request)
    {
        // dd($request);

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

}
