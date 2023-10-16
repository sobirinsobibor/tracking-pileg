<?php

use App\Http\Controllers\super_admin_controllers\TotalVoteController as superAdminTotalVoteController ;
use Illuminate\Support\Facades\Route;

$sub_url = 'superadmin';

Route::resource('/'.$main_url.'/'.$sub_url.'/perolehan-suara', superAdminTotalVoteController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.perolehan-suara',
]);


?>