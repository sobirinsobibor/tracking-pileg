<?php

namespace App\Http\Controllers\user_controllers;

use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){

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

        return view('templating.user-view.index', [
            'voting_places' => $combinedQuery,     
        ]);
    }
}
