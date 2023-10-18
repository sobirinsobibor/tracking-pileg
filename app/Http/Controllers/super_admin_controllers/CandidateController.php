<?php

namespace App\Http\Controllers\super_admin_controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Controllers\Controller;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::select([
            'candidate_name',
            'candidate_gender',
            'candidate_address'
        ])->get();

        return view('templating.super-admin-view.kandidat.index', [
            'candidates' => $candidates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('templating.super-admin-view.kandidat.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        try{
                $artificial_id = $this->makeCandidateAID();
                $validatedData = $request->validate([
                    'candidate_name' => 'required',
                    'candidate_gender' => 'required',
                    'candidate_address' => 'required',
                ]);
    
                $validatedData['candidate_artificial_id'] = $artificial_id;
                if(!$validatedData['candidate_artificial_id']){
                    return view('templating.super-admin-view.kandidat.create')->with('message', ['text' => 'eror in making id (1)', 'class' => 'danger']);
                }
    
                $validatedData['candidate_encrypted_id'] = $this->encrypted_id($artificial_id);
                if(!$validatedData['candidate_artificial_id']){
                    return view('templating.super-admin-view.kandidat.create')->with('message', ['text' => 'eror in making id (2)', 'class' => 'danger']);
                }
    
                $validatedData['created_at'] = now();
                $validatedData['updated_at'] = now();
    
                Candidate::create($validatedData);
                return redirect('/dashboard/superadmin/kandidat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/kandidat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }

    protected function makeCandidateAID(){
        $count = Candidate::count();

        // Menggunakan str_pad untuk menghasilkan format "001"
        $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);

        return $formattedCount;
    }

}
