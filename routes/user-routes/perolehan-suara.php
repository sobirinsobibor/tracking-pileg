<?php

use App\Http\Controllers\user_controllers\TotalVoteController as userTotalVoteController;
use Illuminate\Support\Facades\Route;


$sub_url = 'user';

Route::resource('/'.$main_url.'/'.$sub_url.'/perolehan-suara', userTotalVoteController::class)->names([
    'index' => $main_url.'.'.$sub_url.'.perolehan-suara',
    'create' => $main_url.'.'.$sub_url.'.perolehan-suara.create',
    'create' => $main_url.'.'.$sub_url.'.perolehan-suara.edit',
]);


?>