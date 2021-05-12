<?php

use App\Http\Controllers\OrganizationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});




/**Routes for organization */
Route::get('organizations',[OrganizationController::class , 'index']);

Route::get('organization/{organizationId}',[OrganizationController::class , 'show']);

Route::put('organization/{organizationId}',[OrganizationController::class , 'edit']);


Route::delete('organization/{organizationId}',[OrganizationController::class , 'delete']);