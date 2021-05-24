<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Namshi\JOSE\JWT;

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

/***Authentication Routes */

Route::group([

    // 'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('me', [AuthController::class,'me']);

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

/***Routes for Post */

Route::group([

    'middleware' => 'auth.JWT',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'blog'

], function ($router) {

Route::post('post',[PostController::class , 'create']);

Route::get('posts',[PostController::class,'index']);

Route::get('post/{postId}',[PostController::class , 'show']);


Route::put('post/{postId}',[PostController::class , 'edit']);


Route::delete('post/{postId}',[PostController::class , 'delete']);

});


/***Routes for comment */



Route::post('comment',[CommentController::class , 'create']);

Route::get('comments',[CommentController::class,'index']);

Route::get('comment/{commentId}',[CommentController::class , 'show']);


Route::put('comment/{commentId}',[CommentController::class , 'edit']);


Route::delete('comment/{commentId}',[CommentController::class , 'delete']);




/**reaction routes */

Route::get('reactions',[ReactionController::class,'index']);


Route::post('reaction',[ReactionController::class , 'create']);


Route::get('reaction/{reactionId}',[ReactionController::class , 'show']);


Route::put('reaction/{reactionId}',[ReactionController::class , 'edit']);


Route::delete('reaction/{reactionId}',[ReactionController::class , 'delete']);


Route::get('reaction/{postId}',[ReactionController::class , 'assignPost']);

Route::get('reaction/{commentId}',[ReactionController::class , 'assignComment']);


