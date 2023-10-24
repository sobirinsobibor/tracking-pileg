<?php

use App\Http\Controllers\admin_controllers\DetailLocationOfVotingPlaceController as adminDetailLocationOfVotingPlaceController;
use Illuminate\Support\Facades\Route;

$sub_url = 'admin';

Route::resource('/'.$main_url.'/'.$sub_url.'/pemetaan-petugas', adminDetailLocationOfVotingPlaceController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.pemetaan-petugas',
]);


?>