<?php

use App\Http\Controllers\super_admin_controllers\DetailLocationOfVotingPlaceController as superAdminDetailLocationOfVotingPlaceController;
use Illuminate\Support\Facades\Route;

$sub_url = 'superadmin';

Route::resource('/'.$main_url.'/'.$sub_url.'/pemetaan-petugas', superAdminDetailLocationOfVotingPlaceController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.pemetaan-petugas',
]);


?>