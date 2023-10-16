<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\Party;
use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\Controller;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parties = Party::select([
            'party_name',
            'party_acronym'
        ])->get();
        
        return view('templating.super-admin-view.partai.index',[
            'parties' => $parties
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('templating.super-admin-view.partai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartyRequest $request)
    {
        try{
            $artificial_id = $this->makePartyAID();
    
            $validatedData = $request->validate([
                'party_name' => 'required',
                'party_acronym' => 'required'
            ]);
            $validatedData['party_artificial_id'] = $artificial_id;
            $validatedData['party_encrypted_id'] = $this->encrypted_id($artificial_id);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            Party::create($validatedData);

            return redirect('/dashboard/superadmin/partai')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/partai/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartyRequest $request, Party $party)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        //
    }

    protected function makePartyAID(){
        $count = Party::count();

        // Menggunakan str_pad untuk menghasilkan format "001"
        $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);

        return $formattedCount;
    }
}
