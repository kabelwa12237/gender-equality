<?php

namespace App\Models;

use App\Http\Resources\ReactionResource;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['type','emoji'];
    protected $dates = ["deleted at"];
  
    // relationaships
    // public function users()
    // {
    //     return $this->morphedByMany(User::class, 'reactionabble');
    // }


    public function posts()
    {
        return $this->morphedByMany(Post::class, 'reactionable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'reactionable');
    }

      
    // fetching data from db
    public function allReactions()
    {
        return ReactionResource::collection(Reaction::all());
    }

   

    
    public function getReaction($reactionId){

        $reaction=Reaction::find($reactionId);
        if (!$reaction)return response()->json(["message"=>"Reaction not found"]);
        return new ReactionResource ($reaction);

    }

    public function editReaction($request, $reactionId){

        $reaction=Reaction::find($reactionId);
        if (!$reaction)return response()->json(["message"=>"Reaction not found"]);

        $reaction->update(['type' => $request->type,'emoji' => $request->emoji]);
        return new ReactionResource ($reaction);

    }

    
    public function deleteReaction($request, $reactionId){

        $reaction=Reaction::find($reactionId);
        if (!$reaction)return response()->json(["message"=>"Reaction not found"]);

        $reaction->delete($reactionId);
        return response()->json(["message" => "reactiont deleted successfully"]);
    }

    public function postReaction($request)
    {  
        $validator= Validator::make($request->all(),['type'=>'required','emoji'=>'required']);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],300);
        }

       $reaction=new Reaction();
       $reaction->type=$request->type;
       $reaction->emoji=$request->emoji;


       $reaction->save();

       return new ReactionResource($reaction);

    }

    public function assignReactionToPost($reactionId,$postId){

        $reaction = Reaction::find($reactionId);
        if (!$reaction) return response()->json(["message" => "reaction not found"]);

        $post = Post::find($postId);
        if (!$post) return response()->json(["message" => "post not found"]);

        $reaction->posts()->attach($post);
        return new ReactionResource($reaction);


    }

    public function assignReactionToComment($reactionId,$commentId){

        $reaction = Reaction::find($reactionId);
        if (!$reaction) return response()->json(["message" => "reaction not found"]);

        $comment = Comment::find($commentId);
        if (!$comment) return response()->json(["message" => "comment not found"]);

        $reaction->comments()->attach($comment);
        return new ReactionResource($reaction);


    }

}
