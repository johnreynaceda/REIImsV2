<?php

use App\Http\Controllers\ProfileController;
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
    if (auth()->user()->role_id == 1) {
        return redirect()->route('admin.dashboard');
    }elseif (auth()->user()->role_id == 2) {
        dd('business office');
    }else{
        dd('teacher');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


//admin routes
Route::prefix('administrator')->group(
    function(){
        Route::get('/dashboard', function() {
            return view('admin.index');
        })->name('admin.dashboard');


        //SETTINGS
        Route::get('/settings/users', function() {
            return view('admin.settings.users');
        })->name('admin.settings.users');
        Route::get('/settings/school-year', function() {
            return view('admin.settings.school-year');
        })->name('admin.settings.school-year');
    }
);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
