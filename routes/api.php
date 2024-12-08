<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\ListingApplicationController;

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

//Route::get('get-api', [JobController::class, 'index'])->name="Home";
Route::get('test', function(Request $request){
    return "Authenticated";
});

Route::post('login', [AuthUserController::class, 'login']);
Route::post('register', [AuthUserController::class, 'register']);


Route::resource('jobs', JobController::class);
//'middleware' => 'auth:api', 
    Route::group(['prefix' => 'listing'], function(){
        Route::post('details', [AuthUserController::class, 'details']);
        Route::get('listings', [ListingController::class, 'index']);
        Route::get('show/{id}', [ListingController::class, 'show']);
        Route::post('store', [ListingController::class, 'store']);
        Route::put('/update/{listing}', [ListingController::class, 'update']);
        Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

    
        
        
    })->withoutMiddleware();

    Route::group(['prefix' => 'applied'], function(){
                Route::post('/applied/{id}', [ListingApplicationController::class, 'apply']);
    });
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
