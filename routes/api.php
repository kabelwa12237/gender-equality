<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;

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
Route::get('organizations',[OrganizationController::class,'index']);    
Route::get('onlyorganization/{organizationId}',[OrganizationController::class,'show']);
Route::put('editorganization/{organizationId}',[OrganizationController::class,'edit']);
Route::delete('deleteorganization/{organizationId}',[OrganizationController::class,'destroy']);