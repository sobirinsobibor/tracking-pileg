<?php

use App\Http\Controllers\admin_controllers\TotalVoteController as adminTotalVoteController;
use Illuminate\Support\Facades\Route;

$sub_url = 'admin';

Route::resource('/'.$main_url.'/'.$sub_url.'/perolehan-suara', adminTotalVoteController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.perolehan-suara',
]);


?>