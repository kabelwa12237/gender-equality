<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReportController;
use App\Http\Resources\PostResource;
use App\Http\Controllers\AuthController;

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

//authentication routes
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class,'me']);

});


// organization route

Route::get('organizations',[OrganizationController::class ,'index']);
Route::post('organization',[OrganizationController::class ,'post']);
Route::get('organization/{organizationId}',[OrganizationController::class ,'show']);
Route::put('organization/{organizationId}',[OrganizationController::class ,'edit']);
Route::delete('organization/{organizationId}',[OrganizationController::class ,'destroy']);

// report route
Route::get('reports',[ReportController::class ,'index']);
Route::post('report',[ReportController::class ,'post']);
Route::get('report/{reportId}',[ReportController::class ,'show']);
Route::put('report/{reportId}',[ReportController::class ,'edit']);
Route::delete('report/{reportId}',[ReportController::class ,'destroy']);


// post route
Route::get('posts',[PostController::class,'index']);
Route::get('post/{postId}',[PostController::class ,'show']);
Route::post('post',[PostController::class ,'post']);
Route::put('post/{postId}',[PostController::class ,'edit']);
Route::delete('post/{postId}',[PostController::class ,'destroy']);


// comments route
Route::get('comments',[CommentController::class,'index']);
Route::get('comment/{commentId}',[CommentController::class ,'show']);
Route::put('comment/{commentId}',[CommentController::class ,'edit']);
Route::delete('comment/{commentId}',[CommentController::class ,'destroy']);

// reaction route
Route::get('reactions',[ReactionController::class,'index']);
Route::post('reaction',[ReactionController::class ,'post']);
Route::get('reaction/{reactiontId}',[ReactionController::class ,'show']);
Route::put('reaction/{reactiontId}',[ReactionController::class ,'edit']);
Route::delete('reaction/{reactiontId}',[ReactionController::class ,'destroy']);


// assignment 
Route::get('assign/{reportId}/{organizationId}',[ReportController::class ,'assignReport']);

Route::get('assignpost/{reactionId}/{postId}',[ReactionController::class ,'assignReactionToPost']);
Route::get('assigncomment/{reactiontId}/{commentId}',[ReactionController::class ,'assignReactionToComment']);

Route::post('assignpoxt/{postId}',[CommentController::class ,'assignCommentToPost']);
Route::post('assigncoment/{commentId}',[CommentController::class ,'assignCommentToComment']);












