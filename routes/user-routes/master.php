<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\user_controllers\CandidateController as userCandidateController;
use App\Http\Controllers\user_controllers\PartyController as userPartyController ;
use App\Http\Controllers\user_controllers\UserController as userUserController;
use App\Http\Controllers\user_controllers\VotingPlaceController as userVotingPlaceController;

$sub_url = 'user';

//master tps
Route::resource('/'.$main_url.'/'.$sub_url.'/lokasi-penugasan', userVotingPlaceController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.lokasi-penugasan',
]);

//master kandidat
Route::resource('/'.$main_url.'/'.$sub_url.'/kandidat', userCandidateController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.kandidat',
    'create' => $main_url.'.'.$sub_url.'.kandidat.create',
]);

// master partai
Route::resource('/'.$main_url.'/'.$sub_url.'/partai', userPartyController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.partai',
]);

// master user
Route::resource('/'.$main_url.'/'.$sub_url.'/user', userUserController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.user',
]);



?>