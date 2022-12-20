<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Mail\OrderShipped;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

Route::get('getRole', [AuthController::class, 'getRole'])->name('getRole.index')->middleware('auth:santum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profil', [AuthController::class, 'edit'])->name('profil.edit')->middleware("auth:sanctum");
Route::put('/profil', [AuthController::class, 'update'])->name('profil.update')->middleware("auth:sanctum");


Route::get('/confirm', function($token){
    return response()->json(['url'=>'http://127.0.0.1:5173/confirm']);
});




Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
    // $mailData = [
    //     "nom" => "nabilou",
    //     "prenom" => "nabil"
    // ];
    // Mail::to($request->only('email'));
 
    // return $status === Password::RESET_LINK_SENT
                return response()->json(['message'=>$status]);
})->name('password.email');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'confirm_password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');





Route::post('/contact',[ContactController::class,'store'])->name('contact.store')->middleware("auth:sanctum");;
Route::get('/contact',[ContactController::class,'index'])->name('contact.index')->middleware("auth:sanctum");;

Route::post('/project',[ProjectController::class,'store'])->name('project.store')->middleware("auth:sanctum");
Route::get('/project',[ProjectController::class,'index'])->name('project.index')->middleware("auth:sanctum");

Route::resource('/cracking', CrackingController::class)->middleware("auth:sanctum");
Route::resource('/admin', UserController::class)->middleware("auth:sanctum");
Route::resource('/transaction', TransactionController::class)->middleware("auth:sanctum");


Broadcast::routes(['middleware' => ['auth:sanctum']]);