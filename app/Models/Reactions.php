<?php

namespace App\Models;

use App\Http\Resources\ReactionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Reactions extends Model
{
    use HasFactory;
    use SoftDeletes;

    //reactions

    public function Post()
    {
        return $this->morphedByMany(Posts::class, 'reactionable');
    }


    public function Comment()
    {
        return $this->morphedByMany(Comments::class, 'reactionable');
    }


    protected $fillable = ['reaction_type', 'reaction_emoj'];
    protected $dates = ['deleted_at'];


    public function allReactions()
    {
        return ReactionResource::collection(Reactions::all());
    }

    public function singleReaction($reactionId)
    {
        $reaction = Reactions::find($reactionId);

        if (!$reaction) {
            return response()->json(['error' => 'reaction not found'], 404);
        }

        return new  ReactionResource($reaction);
    }


    public function postReaction($request)
    {

        $validator = Validator::make($request->all(), ['reaction_type' => 'required', 'reaction_emoj' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);
        }
        //first way to add
        $reaction = new Reactions();
        $reaction->reaction_type = $request->reaction_type;
        $reaction->reaction_emoj = $request->reaction_emoj;
        $reaction->save();


        return new ReactionResource($reaction);
    }
    public function editReaction($request, $reactionId)
    {
        $reaction
            = Reactions::find($reactionId);

        if (!$reaction)
            return  response()->json(['error' => 'reaction not found'], 404);


        ///edit function
        $reaction->update([
            'reaction_type' => $request->reaction_type,
            'reaction_emoj' => $request->reaction_emoj,


        ]);
        return new ReactionResource($request, $reaction);
    }


    public function deleteReaction($reactionId)
    {
        $reaction
            = Reactions::find($reactionId);

        if (!$reaction)



            return
                response()->json(['error' => 'reactions does not exist'], 404);

        $reaction->destroy($reactionId);
        return  response()->json(['reaction deleted successfuly ']);
    }


    public function assignReactionToPost($reactionId, $postId)
    {
        $react = Reactions::find($reactionId);
        if (!$react)
            return response()->json(['error' => 'reaction does not found']);



        $post = Posts::find($postId);
        if (!$post)
            return response()->json(['error' => 'post does not found']);


        $react->Post()->attach($post);
        return new ReactionResource($react);
    }



    public function assignReactionToComment($reactionId, $commentId)
    {
        $react = Reactions::find($reactionId);
        if (!$react)
            return response()->json(['error' => 'report does not found']);



        $comment = Comments::find($commentId);
        if (!$comment)
            return response()->json(['error' => 'comment does not found']);


        $react->Post()->attach($comment);
        return new ReactionResource($react);
    }
}
