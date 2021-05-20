<?php

use App\Http\Controllers\CommentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReactionsController;
use App\Http\Controllers\ReportController;
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






//////routes of authentication

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});




//organization rouutes

Route::get('organizations', [OrganizationController::class, 'index']);
Route::post('addorganization', [OrganizationController::class, 'create']);
Route::get('organization/{organizationId}', [OrganizationController::class, 'show']);
Route::put('editorganization/{organizationId}', [OrganizationController::class, 'edit']);

Route::delete('deleteorganization/{organizationId}', [OrganizationController::class, 'destroy']);



//reports routes


Route::get(
    'reports',
    [ReportController::class, 'index']
);
Route::post('postReport', [ReportController::class, 'create']);

Route::get('report/{reportId}', [ReportController::class, 'show']);
Route::put('updateReport/{reportId}', [ReportController::class, 'edit']);
Route::delete('deletereport/{reportId}', [ReportController::class, 'destroy']);
Route::get('assignReport/{reportId}/{organizationId}', [ReportController::class, 'assign']);



//posts routes

Route::get(
    'allposts',
    [PostsController::class, 'index']
);
Route::post('addpost', [PostsController::class, 'create']);
Route::get('post/{postId}', [PostsController::class, 'show']);
Route::put('editpost/{postId}', [PostsController::class, 'edit']);
Route::delete('deletepost/{postId}', [PostsController::class, 'destroy']);


//routes of comments

Route::get(
    'allcomments',
    [
        CommentsController::class, 'index'
    ]
);
Route::post('addcomment', [CommentsController::class, 'create']);
Route::get('comment/{commentId}', [CommentsController::class, 'show']);
Route::put('editcomment/{commentId}', [CommentsController::class, 'edit']);
Route::delete('deletecomment/{commentId}', [CommentsController::class, 'destroy']);


Route::post('assignnewComment/{commentId}', [CommentsController::class, 'assignnewComment']);

Route::post('commentToPost/{postId}', [CommentsController::class, 'assignCommentToPost']);





//routes of reactions
Route::get(
    'allreactions',
    [
        ReactionsController::class, 'index'
    ]
);
Route::post('addreaction', [ReactionsController::class, 'create']);
Route::get('reaction/{reactionId}', [ReactionsController::class, 'show']);
Route::put('editreaction/{reactionId}', [ReactionsController::class, 'edit']);
Route::delete('deletereaction/{reactionId}', [ReactionsController::class, 'destroy']);
Route::get('assignReaction/{reactionId}/{postIdId}', [ReactionsController::class, 'assignment']);
Route::get('assignreaction/{reactionId}/{commentId}', [ReactionsController::class, 'assign']);
