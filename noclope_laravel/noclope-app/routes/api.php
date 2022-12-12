<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/{id}/profil', [AuthController::class, 'edit'])->name('profil.edit')->middleware("auth:sanctum");
Route::put('/{id}/profil', [AuthController::class, 'update'])->name('profil.update')->middleware("auth:sanctum");


Route::post('/contact',[ContactController::class,'store'])->name('contact.store');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

Route::post('/project',[ProjectController::class,'store'])->name('project.store');
Route::get('/project',[ProjectController::class,'index'])->name('project.index');

Route::resource('/cracking', CrackingController::class);

Broadcast::routes(['middleware' => ['auth:sanctum']]);