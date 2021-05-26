<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CommentResource;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * variable
     */
       protected $fillable = [
           "body"
       ];
       protected $dates = ["deleted_at"];


          /**
     * relationships
     */
public function reactions(){
      return $this->morphMany(Reaction::class,'reactionable');
  }
  public function posts(){
    return $this->morphedByMany(Post::class,'commentable');
}
public function comments(){
  return $this->morphedByMany(Comment::class,'commentable');
}

  
  

     /**
  * functions or operation
  */
 //get all Comment fn
 public function allComments() {
  return CommentResource::collection(Comment::all());
 } 

//get a specific Comment fn
 public function getComment($commentId){
    $comment = Comment::find($commentId);
    if(!$comment){
      return response()->json(['message'=>'Comment not found']);
    }
   return new CommentResource($comment);
 }


//edit Comment fn
 public function editOrganization($request,$commentId){
  $comment = Organization::find($commentId);
  if(!$comment)
    return response()->json(['message'=>'Comment not found']);
  
  $comment->update(
    [
      'body'=>$request->body,
    ]
  );
 return new CommentResource($comment);
}

//delete Comment fn
public function deleteComment($commentId){
$comment = Comment::find($commentId);
if(!$comment){
  return response()->json(['message'=>'Comment not found']);
}
$comment->delete($commentId);
return response()->json(['message'=>'Comment deleted successfully']);
}

//comment to a post fun
public function assignCommentToPost($request,$postId){
  $post = Post::find($postId);
  if(!$post)
  return response()->json(['message'=>'post not found']);
  $validator = Validator::make($request->all(),
  [
    'body'=>'required'
  ]);
if($validator->fails())
return response()->json(['error'=>$validator->errors()],300);
$comment = new Comment();
$comment->body = $request->body;
$comment->save();

$comment->posts()->attach($post); 
return new CommentResource($comment);
}

}
