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


   public function reactionables(){
       return $this->morphTo();
   }

    protected $fillable=['type','emoji','reactionable_id','reactionable_type'];
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
        $reaction->user_id=auth()->user->id;
       
        $reaction->save();
    // Comment::create(['body'=>$request->body]);
    return new ReactionResource($reaction);
     }
     /**
      * react to a post
      */

     public function assignReactionToPost($request,$postId){
        $post=Post::find($postId);
    if(!$post){
        return response()->json(['message'=>"post does not exist"]);}

        $validator=Validator::make($request->all(),
        ['type'=>'required','emoji'=>'required']); 

        
        if($validator->fails())
        return response()->json(['error'=>$validator->errors()],300);
        $reaction=new Reaction();
        $reaction->type=$request->type;
        $reaction->emoji=$request->emoji;
        $reaction->user_id=auth()->user()->id;
        $post->reactions()->save($reaction);
    
    
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
$reaction->reactionables()->attach($comment);
return new ReactionResource($reaction);
}

}
