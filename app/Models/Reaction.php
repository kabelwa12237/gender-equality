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

    /**
     * Variables
     */
    protected $fillable = ['emoji', 'type'];
    protected $dates = ['deleted_at'];
    
       /**
     * Get all of the Posts that are assigned this reaction.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'reactionable');
    }

     /**
     * Get all of the Comments that are assigned this reaction.
     */
    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'reactionable');
    }


    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allReactions()
    {
        return ReactionResource::collection(Reaction::all());
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
              'type' => 'required',

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
     public function reactToComment($reactionId, $commentId){
        $reaction = Reaction::find($reactionId);
        if(!$reaction)
        return response()->json(['Error' => 'Sorry! Reaction not Found'], 404);

        $comment = Comment::find($commentId);
        if (!$comment)
           return response()->json(['Error' => 'Sorry! Comment not found'], 404);

        $reaction->comments()->attach($comment);

        return new ReactionResource($reaction);
    }

      /**Assign React to post  */
      public function reactToPost($reactionId, $postId){
        $reaction = Reaction::find($reactionId);
        if(!$reaction)
        return response()->json(['Error' => 'Sorry! Reaction not Found'], 404);

        $post = Post::find($postId);
        if (!$post)
           return response()->json(['Error' => 'Sorry! Post not found'], 404);

        $reaction->posts()->attach($post);

        return new ReactionResource($reaction);
    }

}
