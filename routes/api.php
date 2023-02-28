<?php

use App\Http\Controllers\FeedsPreferencesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsFeedsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SignoutController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class,'authenticateUser']);
    Route::post('/register', [RegisterController::class,"createNewAccount"]);
    Route::resource('sign-out', SignoutController::class);
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('feeds')->group(function () {
        Route::get('/', [NewsFeedsController::class,'getArticles']);
        Route::get('/search', [NewsFeedsController::class,'getArticlesBySearch']);
        Route::get('/preference', [NewsFeedsController::class,'getArticlesByPreference']);
    });

    Route::prefix('settings')->group(function(){
        Route::get('/user/{id}', [SettingsController::class,'profileSettings'])->name('profile-settings');
    });

    Route::resource('users', UsersController::class);
    Route::resource('feeds-preferences', FeedsPreferencesController::class);
    Route::resource('sign-out', SignoutController::class);
});
