<?php

namespace App\Http\Controllers\user_controllers;

use App\Models\Party;
use App\Models\Candidate;
use App\Models\TotalVote;
use App\Models\VotingPlace;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTotalVoteRequest;
use App\Http\Requests\UpdateTotalVoteRequest;
use App\Models\CandidateVote;
use App\Models\DetailLocationOfVotingPlace;
use App\Models\IdentityVote;

class TotalVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            ->join('detail_location_of_voting_places', 'voting_places.voting_place_encrypted_id', '=', 'detail_location_of_voting_places.id_voting_place')
            ->where('detail_location_of_voting_places.id_user', Auth::user()->id)
            ->first();

        //data suara
        $candidatevotestps = DB::table('candidate_votes')->select(
                                'candidate_votes.candidate_vote_vote_count', 
                                'voting_places.voting_place_name'
                            )->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                             ->join('detail_location_of_voting_places', 'detail_location_of_voting_places.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                             ->where('detail_location_of_voting_places.id_user', '=', Auth::user()->id)
                             ->first();
        $partyvotestps = DB::table('total_votes')->select(
                                'total_votes.total_vote_vote_count', 
                                'parties.party_name'
                            )->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')
                             ->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                             ->join('detail_location_of_voting_places', 'detail_location_of_voting_places.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')
                             ->where('detail_location_of_voting_places.id_user', '=', Auth::user()->id)
                             ->get();

        if($candidatevotestps && $partyvotestps){ //kalo ada (sudah ngumpulin)
            $labelspartaipertps = [];
            $datapartaipertps = [];
    
            $datapertps = (int)$candidatevotestps->candidate_vote_vote_count;
    
            foreach ($partyvotestps as $partaitpsdata) {
                $labelspartaipertps[] = $partaitpsdata->party_name;
                $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
            }
            return view('templating.user-view.perolehan-suara.index', [
                'voting_places' => $combinedQuery,
                'datapertps' => $datapertps,
                'labelspartaipertps' => array_values($labelspartaipertps),
                'datapartaipertps' => array_values($datapartaipertps)
            ]);
        }else{
            return view('templating.user-view.perolehan-suara.index', [
                'voting_places' => $combinedQuery,                
            ]);
        }
       
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
    public function store(StoreTotalVoteRequest $request)
    {
        try{
            $request->validate([
                 'id_voting_place' => 'required',
                 'id_candidate' => 'required',
                 'candidate_vote_vote_count' => 'required',
                 'id_party' => 'required',
                 'total_vote_vote_count' => 'required',
                 'id_user' => 'required'
            ]);

            $id_voting_place = $request->id_voting_place;
            $id_candidate = $request->id_candidate;
            $count_id_candidate = count($request->input('id_candidate'));
            $count_candidate_vote_vote_count = count($request->input('candidate_vote_vote_count'));
            $count_id_party = count($request->input('id_party'));
            $count_total_vote_vote_count =count($request->input('total_vote_vote_count'));

            //dblock commit
            try {
                DB::beginTransaction();
                
                    //identity_votes
                    $identity_votes = IdentityVote::create([
                        'id_user' => $request->id_user,
                        'id_voting_place' => $id_voting_place,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]); 
                    event(new Registered($identity_votes));

                    //candidate_votes
                    if($count_id_candidate === $count_candidate_vote_vote_count){
                        for($i=0; $i<$count_id_candidate; $i++){
                            $candidate_votes = CandidateVote::create([
                                'candidate_vote_vote_count' => $request->candidate_vote_vote_count[$i],
                                'id_voting_place' => $id_voting_place,
                                'id_candidate' => $id_candidate[$i],
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                            event(new Registered($candidate_votes));
                        }
                    }else{
                        return false;
                    }
                    
                    //total_votes
                    if($count_id_party === $count_total_vote_vote_count){
                        for($i=0; $i<$count_id_party; $i++){
                            $total_votes = TotalVote::create([
                                'total_vote_vote_count' => $request->total_vote_vote_count[$i],
                                'id_party' => $request->id_party[$i],
                                'id_voting_place' => $id_voting_place,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                            event(new Registered($total_votes));
                        }
                    }else{
                        return false;
                    }

                // Jika semua perintah berhasil, konfirmasikan transaksi
                DB::commit();
            } catch (\Exception $e) {
                // Jika terjadi kesalahan, batalkan transaksi
                DB::rollback();
                return redirect('/dashboard/user/perolehan-suara/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
            }

            return redirect('/dashboard/user/perolehan-suara')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/user/perolehan-suara/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TotalVote $totalVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $identity_voting = IdentityVote::where('id_voting_place', '=', $id)->exists();
        //id_tps harus sama dengan id_user
        $detail_voting = DetailLocationOfVotingPlace::where('id_voting_place', '=', $id)->where('id_user', '=', Auth::user()->id)->exists();

        if($detail_voting){ //id_tps sama dengan id_user
            if($identity_voting){ //kl sudah ada
                return redirect('/dashboard/user/perolehan-suara')->with('message', ['text' => 'Pengumpulan Suara Hanya Bisa Dilakukan Satu Kali', 'class' => 'danger']);
            }else{
                try{
                    $candidate = Candidate::select([
                        'candidate_name',
                        'candidate_encrypted_id'
                    ])->get();
            
                    $parties = Party::select([
                        'party_encrypted_id',
                        'party_name',
                        'party_acronym'
                    ])->get();
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
                        ->join('detail_location_of_voting_places', 'voting_places.voting_place_encrypted_id', '=', 'detail_location_of_voting_places.id_voting_place')
                        ->where('detail_location_of_voting_places.id_user', Auth::user()->id)
                        ->first();
                        return view('templating.user-view.perolehan-suara.create', [
                            'candidates' => $candidate,
                            'parties' => $parties,
                            'voting_places' => $combinedQuery
                        ]);
                }catch(\Exception $e){
                    return redirect('/dashboard/user/perolehan-suara')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
                }
            }    
        }else{
            return redirect('/dashboard/user/perolehan-suara')->with('message', ['text' => 'Anda Tidak Memiliki Akses', 'class' => 'danger']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTotalVoteRequest $request, TotalVote $totalVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalVote $totalVote)
    {
        //
    }
}
