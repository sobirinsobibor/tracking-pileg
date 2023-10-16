<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\super_admin_controllers\CandidateController as superAdminCandidateController;
use App\Http\Controllers\super_admin_controllers\ElectoralDistrictController as superAdminElectoralDistrictController;
use App\Http\Controllers\super_admin_controllers\PartyController as superAdminPartyController ;
use App\Http\Controllers\super_admin_controllers\UserController as superAdminUserController;
use App\Http\Controllers\super_admin_controllers\VotingPlaceController as superAdminVotingPlaceController;

$sub_url = 'superadmin';

//master dapil
Route::resource('/'.$main_url.'/'.$sub_url.'/dapil', superAdminElectoralDistrictController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.dapil',
]);

//master tps
Route::resource('/'.$main_url.'/'.$sub_url.'/tps', superAdminVotingPlaceController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.tps',
    'show' =>  $main_url.'.'.$sub_url.'.tps.show',
]);

//master kandidat
Route::resource('/'.$main_url.'/'.$sub_url.'/kandidat', superAdminCandidateController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.kandidat',
    'create' => $main_url.'.'.$sub_url.'.kandidat.create',
]);

// master partai
Route::resource('/'.$main_url.'/'.$sub_url.'/partai', superAdminPartyController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.partai',
]);

// master user
Route::resource('/'.$main_url.'/'.$sub_url.'/user', superAdminUserController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.user',
]);



?>