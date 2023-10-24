<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin_controllers\CandidateController as adminCandidateController;
use App\Http\Controllers\admin_controllers\DistrictController as adminDistrictController;
use App\Http\Controllers\admin_controllers\ElectoralDistrictController as adminElectoralDistrictController;
use App\Http\Controllers\admin_controllers\PartyController as adminPartyController ;
use App\Http\Controllers\admin_controllers\SubDistrictController as adminSubDistrictController;
use App\Http\Controllers\admin_controllers\UserController as adminUserController;
use App\Http\Controllers\admin_controllers\VotingPlaceController as adminVotingPlaceController;

$sub_url = 'admin';

//master dapil
Route::resource('/'.$main_url.'/'.$sub_url.'/dapil', adminElectoralDistrictController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.dapil',
]);

//master tps
Route::resource('/'.$main_url.'/'.$sub_url.'/tps', adminVotingPlaceController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.tps',
]);

//master kandidat
Route::resource('/'.$main_url.'/'.$sub_url.'/kandidat', adminCandidateController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.kandidat',
    'create' => $main_url.'.'.$sub_url.'.kandidat.create',
]);

// master partai
Route::resource('/'.$main_url.'/'.$sub_url.'/partai', adminPartyController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.partai',
]);

// master desa
Route::resource('/'.$main_url.'/'.$sub_url.'/desa', adminSubDistrictController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.desa',
]);
// master kecamatab
Route::resource('/'.$main_url.'/'.$sub_url.'/kecamatan', adminDistrictController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.kecamatan',
]);

// master user
Route::resource('/'.$main_url.'/'.$sub_url.'/user', adminUserController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.user',
]);



?>