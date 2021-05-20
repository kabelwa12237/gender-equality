<?php

namespace App\Models;

use App\Http\Resources\ReactionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['type', 'emoji'];
    protected $dates = ['deleted_at'];



    public function posts(){

        return $this->morphedByMany(Post::class,'reactionable');
    }

    public function comments(){
        return $this->morphedByMany(Comment::class,'reactionable');
    }

    public function allReactions()
    {
        return ReactionResource::collection(Reaction::all());
    }


    public function getReaction($reactionId)
    {
        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['message' => 'REACTION ONT FOUND']);
        return new ReactionResource($reactionId);
    }
    public function editReaction($request, $reactionId)
    {
        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['message' => 'REACTION ONT FOUND']);

        /***EDITING */
        $reaction->update([
            'type' => $request->type,
            'emoji' => $request->emoji
        ]);
        return new ReactionResource($reaction);
    }

    public function deleteReaction($reactionId)
    {

        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['message' => 'DELETED ID NOT FOUND']);

        /**deleting */
        $reaction->delete();
        return response()->json(['deleted successfully']);
    }
    public function postReaction($request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'emoji' => 'required'

        ]);

     

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 300);
            $reaction=  Reaction::create([
            'type' => $request->type,
            'emoji' => $request->emoji


        ]);
        return new ReactionResource($reaction);
    }

/***Assign recti */

    public function assignReactToComment($reactionId, $commentId)
    {

        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['message' => 'reaction not found']);


        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['message'=>'comment not found']);


        $reaction->comments()->attach($comment);
        return new ReactionResource($reaction);
    }


    public function assignReactTopost($reactionId, $postId)
    {

        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['message' => 'reaction not found']);


        $post = Comment::find($postId);
        if (!$post)
            return response()->json(['message'=>'post not found']);


        $reaction->posts()->attach($post);
        return new ReactionResource($reaction);
    }
}
