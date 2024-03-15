<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\RegisterUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class ,'index']);
    Route::get('/add-skill', [DashboardController::class ,'addSkill']);
});
Route::get('/logout',function(){
    auth()->logout();
    return redirect('/');
});
