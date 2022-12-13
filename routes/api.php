<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\MovieRatingController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(array('middleware' => ['custom_auth']), function ()
{
    Route::apiResource('token', TokenController::class);
    Route::post('/token/topup', [TokenController::class, 'store']);
});

// Add dummy data to check user access
Route::get('/roles', [PermissionController::class,'Permission']);

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware(['auth:sanctum', 'ability:movie-list'])->group( function () {
    Route::get('genre', [MovieController::class, 'byGenre']);
    Route::get('timeslot', [MovieController::class, 'byTimeSlot']);
    Route::get('specific_movie_theater', [MovieController::class, 'bySpecificMovieTheater']);
    Route::get('search_performer', [MovieController::class, 'byPerformer']);
    Route::post('give_rating', [MovieRatingController::class, 'giveMovieRating']);
    Route::get('new_movies', [MovieController::class, 'getNewMovies']);
});

Route::post('add_movie', [MovieController::class, 'addMovie'])->middleware(['auth:sanctum', 'ability:movie-add']);

Route::post('movies/{movie}/ratings', [MovieRatingController::class, 'store']);





