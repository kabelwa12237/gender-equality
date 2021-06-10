<?php

namespace App\Models;

use App\Events\ReactionSubmitted;
use App\Http\Resources\ReactionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Variables
     */
    protected $fillable = ['emoji', 'type', 'user_id'];
    protected $dates = ['deleted_at'];

    /**
     * Get the parent reactionable model (post or comment).
     */
    public function reactionable()
    {
        return $this->morphTo(Post::class, Comment::class);
    }


    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allReactions()
    {
        return ReactionResource::collection(Reaction::all()->sortDesc());
    }

    /**get single Function */
    public function getReaction($reactionId)
    {
        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        return new ReactionResource($reaction);
    }

    /**Edit Function */
    public function editReaction($request, $reactionId)
    {
        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $reaction->update([
            'emoji' => $request->emoji,
            'type' => $request->type,
        ]);

        return new ReactionResource($reaction);
    }

    /**Delete Function */
    public function deleteReaction($reactionId)
    {
        $reaction = Reaction::find($reactionId);
        if (!$reaction)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $reaction->destroy($reactionId);
        return response()->json(['Hello! Report deleted'], 200);
    }

    /**Post Function */
    public function postReaction($request)
    {
        $validator = Validator::make($request->all(), [
            'emoji' => 'required',
            'type' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        $reaction = new Reaction();
        $reaction->emoji = $request->emoji;
        $reaction->type = $request->type;

        $reaction->save();


        return new ReactionResource($reaction);
    }

    /**Assign React to comment  */
    public function reactToComment($request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['Error' => 'Sorry! Comment not found'], 404);

        $validator = Validator::make($request->all(), [
            'emoji' => 'required',
            'type' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        $reaction = new Reaction();
        $reaction->emoji = $request->emoji;
        $reaction->type = $request->type;
        $reaction->user_id = auth()->user()->id;

        $comment->reactions()->save($reaction);

        return new ReactionResource($reaction);
    }

    /**Assign React to post  */
    public function reactToPost($request, $postId)
    {

        $post = Post::find($postId);
        if (!$post)
            return response()->json(['Error' => 'Sorry! Post not found'], 404);

        $validator = Validator::make($request->all(), [
            'emoji' => 'required',
            'type' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        $reaction = new Reaction();
        $reaction->emoji = $request->emoji;
        $reaction->type = $request->type;
        $reaction->user_id = auth()->user()->id;

        $post->reactions()->save($reaction);


        return new ReactionResource($reaction);
    }
}
