<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReportController;

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

  /**
     * these are routes of the organization
     */

Route::post('organization',[OrganizationController::class,'post']);
Route::get('organizations',[OrganizationController::class,'index']); 
Route::get('organization/{organizationId}',[OrganizationController::class,'show']);
Route::put('editorganization/{organizationId}',[OrganizationController::class,'edit']);
Route::delete('deleteorganization/{organizationId}',[OrganizationController::class,'destroy']);

/**
 * These are routes for reports
 */
Route::get('reports',[ReportController::class,'index']);
Route::post('report',[ReportController::class,'post']);
Route::get('report/{reportId}',[ReportController::class,'show']);
Route::put('editreport/{reportId}',[ReportController::class,'edit']);
Route::delete('deletereport/{reportId}',[ReportController::class,'destroy']);
Route::get('assign/{reportId}/{organizationId}',[ReportController::class,'assignReport']);