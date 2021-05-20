<?php

namespace App\Models;

use App\Http\Resources\CommentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['body'];
    protected $dates =['deleted_at'];
      

    
public function reactions(){
     return $this->morphToMany(Reaction::class,'reactionables');
 }
 
 


public function allComments(){

    return CommentResource::collection(Post::all());
}
 
public function getComment($commentId){

    
    $comment=Comment::find($commentId);
    if(!$comment)
    return response()->json(['Message'=>'Comment not found']);
    return new CommentResource($commentId);
}

public function editComment($request ,$commentId)
{
    $comment = Comment::find($commentId);
    if (!$comment)
        return response()->json(['message' => 'POST not FOUND']);

    /***EDITING */

    $comment->update(['body' =>$request->body]);
    return new CommentResource($comment);
}

public function deleteComment($commentId)
{

     $comment = Comment::find($commentId);
     if (!$comment)
          return response()->json(['message' => 'DELETED ID NOT FOUND']);

          /**deleting */
     $comment->delete();
     return response()->json(['deleted successfully']);
}
public function postComment($request)
{
     $validator = Validator::make($request->all(), [
          'body' => 'required',
         
     ]);

     

     if ($validator->fails())
          return response()->json(['error' => $validator->errors()], 300);
     $comment=Comment::create([
          'body' => $request->body,
          
     ]);
     return new CommentResource($comment);



     
}
}
