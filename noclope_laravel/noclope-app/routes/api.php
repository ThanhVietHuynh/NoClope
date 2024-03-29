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
use App\Models\Contact;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;


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

Route::put('/invitation/{remember_token}', [ContactController::class, 'addContact'])->name('contacts.update');
Route::delete('/delete/{remember_token}', [ContactController::class, 'deleteContact'])->name('contacts.delete');
Route::get('/mailcracking', [ContactController::class, 'mailCracking'])->name('contacts.mailCrack')->middleware('auth:sanctum');

Route::get('getRole', [AuthController::class, 'getRole'])->name('getRole.index')->middleware('auth:sanctum');
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

Route::get('/send-mail', [ContactController::class, 'sendMail']);


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => ['required','string','max:255', RulesPassword::min(8)->numbers(), RulesPassword::min(8)->mixedCase(),RulesPassword::min(8)->letters()], //Password::min(8)->symbols(),
        'password_confirmation' => ['required','string','max:255', RulesPassword::min(8)->numbers(), RulesPassword::min(8)->mixedCase(),RulesPassword::min(8)->letters()], //Password::min(8)->symbols(),
        'token' => 'required',
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
 
    // return $status === Password::PASSWORD_RESET
                return response()->json(['message'=>'Succées']);
})->middleware('guest')->name('password.update');





Route::post('/contact',[ContactController::class,'store'])->name('contact.store')->middleware("auth:sanctum");;
Route::get('/contact',[ContactController::class,'index'])->name('contact.index')->middleware("auth:sanctum");;

Route::post('/project',[ProjectController::class,'store'])->name('project.store')->middleware("auth:sanctum");
Route::get('/project',[ProjectController::class,'index'])->name('project.index')->middleware("auth:sanctum");

Route::resource('/cracking', CrackingController::class)->middleware("auth:sanctum");
Route::resource('/admin', UserController::class)->middleware("auth:sanctum");
Route::resource('/transaction', TransactionController::class)->middleware("auth:sanctum");


Broadcast::routes(['middleware' => ['auth:sanctum']]);