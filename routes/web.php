<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\super_admin_controllers\DashboardController as superadminDashboardController;
use App\Http\Controllers\admin_controllers\DashboardController as adminDashboardController;
use App\Http\Controllers\user_controllers\DashboardController as userDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/db', function(){
    return view('templating.index');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'superAdminMiddleware']], function() {
    $main_url = 'dashboard';

    Route::get('/dashboard/superadmin', [superadminDashboardController::class, 'index'])->name('dashboard.superadmin');

    require __DIR__.'/super-admin-routes/master.php';
    require __DIR__.'/super-admin-routes/pemetaan-petugas.php';
    require __DIR__.'/super-admin-routes/perolehan-suara.php';

});

Route::middleware(['adminMiddleware'])->group(function () {
    $main_url = 'dashboard';

    Route::get('/dashboard/admin', [adminDashboardController::class, 'index'])->name('dashboard.admin');

    require __DIR__.'/admin-routes/master.php';
    require __DIR__.'/admin-routes/perolehan-suara.php';
});

Route::middleware(['userMiddleware'])->group(function () {
    $main_url = 'dashboard';

    Route::get('/dashboard/user', [userDashboardController::class, 'index'])->name('dashboard.user');

    require __DIR__.'/user-routes/master.php';
    require __DIR__.'/user-routes/perolehan-suara.php';

});
