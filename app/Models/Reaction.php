<?php

namespace App\Models;

use App\Http\Resources\ReactionResource;
use App\Http\Resources\ReportResource;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * variable
     */
    //    protected $fillable = [
    //    ];
       protected $dates = ["deleted_at"];
   

    /**
     * relationships
     */
   public function posts(){
     return $this->morphedByMany(Post::class,'reactionable');
   }
   public function comments(){
    return $this->morphedByMany(Comment::class,'reactionable');
  }
     
     /**
  * functions or operation
  */

    //get a all reaction fn
  public function allReactions(){
return ReactionResource::collection(Reaction::all());
  }

  //get a specific reaction fn
  public function getReaction($reactionId){
   $reaction = Reaction::find($reactionId);
   if(!$reaction){
     return response()->json(['message'=>'reaction not found']);
   }
  return new reactionResource($reaction);
}

  //post a reaction fn
  public function createReaction($request){
$validator = Validator::make($request->all(),[
'type'=>'required',
'emoji'=>'required'
]);
if($validator->fails())
return response()->json(['error'=>$validator->errors()],300);
$reaction = new Reaction();
$reaction->type = $request->type;
$reaction->emoji = $request->emoji;
$reaction->save();

return new ReactionResource($reaction); 
  }

  //edit a reaction fn
  public function editReaction($request,$reactionId)
  {
    $reaction = Reaction::find($reactionId);
    if(!$reaction)
      return response()->json(["message"=> "reaction not found"]);
    $reaction->update([
'type'=>$request->type,
'emoji'=>$request->emoji,
    ]);
    return new ReactionResource($reaction);
  }

  //delete Reaction
  public function deleteReaction($reactionId){
    $reaction = Reaction::find($reactionId);
    if(!$reaction)
    return response()->json([
      'message'=>'Reaction not found'
    ]);
    $reaction->delete($reactionId);
    return response()->json(['message'=>'Reaction deleted successfully']);
  }


public function assignReactionToPost($reactionId,$postId){
$reaction = Reaction::find($reactionId);
if(!$reaction)
return response()->json([
  'message'=>'Reaction not found'
]);
$post = Post::find($postId);
if(!$post)
return response()->json([
  'message'=>'Post not found'
]);
$reaction->posts->attach($post);
return new ReactionResource($reaction);

}
public function assignReactionToComment($reactionId,$commentId){
  $reaction = Reaction::find($reactionId);
  if(!$reaction)
  return response()->json([
    'message'=>'Reaction not found'
  ]);
$comment = Comment::find($commentId);
if(!$comment)
return response()->json([
  'message'=>'Comment not found'
]);
$reaction->comments->attach($comment);
return new ReactionResource($reaction);
}

}