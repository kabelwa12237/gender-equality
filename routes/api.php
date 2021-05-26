<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

use App\Models\Reaction;

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

////////////////////////routes za authentication/////////////////////////////
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
///////////////////////////organization route/////////////////////////////                                            
Route::get('organizations',[OrganizationController::class,'index']);
Route::post('createorganization',[OrganizationController::class,'store']);
Route::get('organization/{organizationId}',[OrganizationController::class,'show']);
Route::put('organization/{organizationId}',[OrganizationController::class,'edit']);
Route::delete('deleteorganization/{organizationId}',[OrganizationController::class,'destroy']);


/////////////////////////////////report route///////////////////////////////////////////                                        
Route::get('reports',[ReportController::class,'index']);
Route::post('createReport',[ReportController::class,'store']); 
Route::get('report/{reportId}',[ReportController::class,'show']);
Route::put('report/{reportId}',[ReportController::class,'edit']);
Route::delete('deleteReport/{reportId}',[ReportController::class,'destroy']);


///////////////////////////////////Comment route////////////////////////////////////////                                  
Route::get('comments',[CommentController::class,'index']);             
Route::get('comment/{commentId}',[CommentController::class,'show']);  
Route::post('commentToPost/{postId}',[CommentController::class,'assignCommentToPost']);
Route::get('report/{reportId}',[ReportController::class,'show']);  
Route::delete('deleteReport/{reportId}',[ReportController::class,'destroy']);



/////////////////////////////////reaction route////////////////////////////////////////                                            
Route::get('reactions',[ReactionController::class,'index']);
Route::get('reaction/{reactionId}',[ReactionController::class,'show']); 
Route::put('editReaction/{reactionId}',[ReactionController::class,'update']); 
Route::delete('deleteReaction/{reactionId}',[ReactionController::class,'destroy']);   
Route::post('attachReactionToPost/{postId}',[ReactionController::class,'attachReactionToPost']);  
Route::post('attachReactionToComment/{reactionId}/{commentId}',[ReactionController::class,'attachReactionToComment']);



///////////////////////////posts route////////////////////////////                                           
Route::get('posts',[PostController::class,'index']);
Route::post('createPost',[PostController::class,'store']); 
Route::get('post/{postId}',[PostController::class,'show']);   
Route::post('postMedia',[PostController::class,'postMediaToPost']);

