<?php

namespace App\Models;

use App\Http\Controllers\ReactionController;
use App\Http\Resources\ReactionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;



class Reaction extends Model 
{
    use HasFactory;
    use SoftDeletes;


    public function posts()
    {
        return $this->morphedByMany(Post::class, 'reactionable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'reactionable');
    }

    protected $fillable=['type','emoji'];
    protected $dates=['deleted_at'];

    public function allReactions(){
        return ReactionResource::collection(Reaction::all());
    }
    public function getReaction($reactionId){
        $reaction=Reaction::find($reactionId);
        if(!$reaction)
           return response()->json(['message'=>"reaction does not exist"]);
           return new ReactionResource($reaction);
    }
    public function editReaction($request,$reactionId){
        $reaction=Reaction::find($reactionId);
        if(!$reaction)
        return response()->json(['message'=>"reaction does not exist"]);
        $reaction->update([
           'type'=>$request->type,
           'emoji'=>$request->emoji]);
           return new ReactionResource($reactionId);
        }
        public function deleteReaction($reactionId) {
            $reaction=Reaction::find($reactionId);
            if(!$reaction)
            return response()->json(['message'=>"reaction does not exist"]);
            $reaction->destroy($reactionId);
            return response()->json(['message'=>"reaction deleted successfully"]);
              }
      

    public function postReaction($request){
        $validator=Validator::make($request->all(),
        ['type'=>'required','emoji'=>'required']); 

        
        if($validator->fails())
        return response()->json(['error'=>$validator->errors()],300);
        $reaction=new Reaction();
        $reaction->type=$request->type;
        $reaction->emoji=$request->emoji;
        $reaction->save();
    // Comment::create(['body'=>$request->body]);
    return new ReactionResource($reaction);
     }
     /**
      * react to a post
      */

     public function assignReactionToPost($reactionId,$postId){
        $reaction = Reaction::find($reactionId);
       if(!$reaction)
        return response()->json(['message'=>"reaction does not exist"]);
         $post = Post::find($postId);
    if(!$post){
        return response()->json(['message'=>"post does not exist"]);}
    $reaction->posts()->attach($post);
    return new ReactionResource($reaction);
}
/**
 * react to comment
 */
public function assignReactionToComment($reactionId,$commentId){
    $reaction = Reaction::find($reactionId);
   if(!$reaction)
    return response()->json(['message'=>"reaction does not exist"]);
     $comment = Comment::find($commentId);
if(!$comment){
    return response()->json(['message'=>"post does not exist"]);}
$reaction->comments()->attach($comment);
return new ReactionResource($reaction);
}

}
