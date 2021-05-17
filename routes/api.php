<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReportController;
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
Route::post('organization',[OrganizationController::class , 'post']);

Route::get('organizations',[OrganizationController::class , 'index']);

Route::get('organization/{organizationId}',[OrganizationController::class , 'show']);

Route::put('organization/{organizationId}',[OrganizationController::class , 'edit']);


Route::delete('organization/{organizationId}',[OrganizationController::class , 'delete']);

/**Routes for reports */
Route::post('report',[ReportController::class , 'post']);

Route::get('reports',[ReportController::class,'index']);

Route::get('report/{reportId}',[ReportController::class , 'show']);

Route::put('report/{reportId}',[ReportController::class , 'edit']);

Route::delete('report/{reportId}',[ReportController::class , 'delete']);


Route::get('assign/{reportId}/{organizationId}',[ReportController::class , 'assignReport']);


