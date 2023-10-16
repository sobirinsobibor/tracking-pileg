<?php

namespace App\Http\Controllers\admin_controllers;

use App\Models\TotalVote;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTotalVoteRequest;
use App\Http\Requests\UpdateTotalVoteRequest;
use Illuminate\Http\Request;

class TotalVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pilihtps = $request->input('pilihtps');
        $pilihdapil = $request->input('pilihdapil');
        $listtps = DB::table('voting_places')->get();
        $listdapil = DB::table('electoral_districts')->get();

        if ($pilihtps != null) {
            $idtpspilihan = $pilihtps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idtpspilihan = $listtps[0]->id;
            } else {
                $idtpspilihan = 0;
            }
        }

        if ($pilihdapil != null) {
            $iddapilpilihan = $pilihdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $iddapilpilihan = $listdapil[0]->id;
            } else {
                $iddapilpilihan = 0;
            }
        }

        $candidatevotestps = DB::table('candidate_votes')->select('candidate_votes.candidate_vote_vote_count', 'voting_places.voting_place_name')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->get();
        $candidatevotesdapil = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'electoral_districts.electoral_district_name')->groupBy('electoral_districts.electoral_district_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->get();
        $partyvotestps = DB::table('total_votes')->select('total_votes.total_vote_vote_count', 'parties.party_name')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->where('voting_places.id', $idtpspilihan)->get();
        $partyvotesdapil = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->where('electoral_districts.id', $iddapilpilihan)->get();
        $tampilnamatps = DB::table('voting_places')->where('id', $idtpspilihan)->first();
        $tampilnamadapil = DB::table('electoral_districts')->where('id', $iddapilpilihan)->first();

        $labelspertps = [];
        $datapertps = [];
        $labelsperdapil = [];
        $dataperdapil = [];
        $labelspartaipertps = [];
        $datapartaipertps = [];
        $labelspartaiperdapil = [];
        $datapartaiperdapil = [];

        foreach ($candidatevotestps as $tpsdata) {
            $labelspertps[] = $tpsdata->voting_place_name;
            $datapertps[] = (int)$tpsdata->candidate_vote_vote_count;
        }

        foreach ($candidatevotesdapil as $dapildata) {
            $labelsperdapil[] = $dapildata->electoral_district_name;
            $dataperdapil[] = (int)$dapildata->total_vote_count;
        }
        foreach ($partyvotestps as $partaitpsdata) {
            $labelspartaipertps[] = $partaitpsdata->party_name;
            $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
        }

        foreach ($partyvotesdapil as $partaidapildata) {
            $labelspartaiperdapil[] = $partaidapildata->party_name;
            $datapartaiperdapil[] = (int)$partaidapildata->total_vote_count;
        }
        return view('templating.admin-view.perolehan-suara.index', [
            'listtps' => $listtps,
            'listdapil' => $listdapil,
            'tampilnamatps' => $tampilnamatps,
            'tampilnamadapil' => $tampilnamadapil,
            'labelspertps' => array_values($labelspertps),
            'datapertps' => array_values($datapertps),
            'labelsperdapil' => array_values($labelsperdapil),
            'dataperdapil' => array_values($dataperdapil),
            'labelspartaipertps' => array_values($labelspartaipertps),
            'datapartaipertps' => array_values($datapartaipertps),
            'labelspartaiperdapil' => array_values($labelspartaiperdapil),
            'datapartaiperdapil' => array_values($datapartaiperdapil)
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
    public function store(StoreTotalVoteRequest $request)
    {
        $pilihtps = $request->input('pilihtps');
        $pilihdapil = $request->input('pilihdapil');
        $listtps = DB::table('voting_places')->get();
        $listdapil = DB::table('electoral_districts')->get();

        if ($pilihtps != null) {
            $idtpspilihan = $pilihtps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idtpspilihan = $listtps[0]->id;
            } else {
                $idtpspilihan = 0;
            }
        }

        if ($pilihdapil != null) {
            $iddapilpilihan = $pilihdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $iddapilpilihan = $listdapil[0]->id;
            } else {
                $iddapilpilihan = 0;
            }
        }

        $candidatevotestps = DB::table('candidate_votes')->select('candidate_votes.candidate_vote_vote_count', 'voting_places.voting_place_name')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->get();
        $candidatevotesdapil = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'electoral_districts.electoral_district_name')->groupBy('electoral_districts.electoral_district_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->get();
        $partyvotestps = DB::table('total_votes')->select('total_votes.total_vote_vote_count', 'parties.party_name')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->where('voting_places.id', $idtpspilihan)->get();
        $partyvotesdapil = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->where('electoral_districts.id', $iddapilpilihan)->get();
        $tampilnamatps = DB::table('voting_places')->where('id', $idtpspilihan)->first();
        $tampilnamadapil = DB::table('electoral_districts')->where('id', $iddapilpilihan)->first();

        $labelspertps = [];
        $datapertps = [];
        $labelsperdapil = [];
        $dataperdapil = [];
        $labelspartaipertps = [];
        $datapartaipertps = [];
        $labelspartaiperdapil = [];
        $datapartaiperdapil = [];

        foreach ($candidatevotestps as $tpsdata) {
            $labelspertps[] = $tpsdata->voting_place_name;
            $datapertps[] = (int)$tpsdata->candidate_vote_vote_count;
        }

        foreach ($candidatevotesdapil as $dapildata) {
            $labelsperdapil[] = $dapildata->electoral_district_name;
            $dataperdapil[] = (int)$dapildata->total_vote_count;
        }
        foreach ($partyvotestps as $partaitpsdata) {
            $labelspartaipertps[] = $partaitpsdata->party_name;
            $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
        }

        foreach ($partyvotesdapil as $partaidapildata) {
            $labelspartaiperdapil[] = $partaidapildata->party_name;
            $datapartaiperdapil[] = (int)$partaidapildata->total_vote_count;
        }
        return view('templating.admin-view.perolehan-suara.index', [
            'listtps' => $listtps,
            'listdapil' => $listdapil,
            'tampilnamatps' => $tampilnamatps,
            'tampilnamadapil' => $tampilnamadapil,
            'labelspertps' => array_values($labelspertps),
            'datapertps' => array_values($datapertps),
            'labelsperdapil' => array_values($labelsperdapil),
            'dataperdapil' => array_values($dataperdapil),
            'labelspartaipertps' => array_values($labelspartaipertps),
            'datapartaipertps' => array_values($datapartaipertps),
            'labelspartaiperdapil' => array_values($labelspartaiperdapil),
            'datapartaiperdapil' => array_values($datapartaiperdapil)
        ]);

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
    public function edit(TotalVote $totalVote)
    {
        //
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
