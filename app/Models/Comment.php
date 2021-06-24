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

    /**
     * Variables
     */
    protected $fillable = ['body', 'user_id'];
    protected $dates = ['deleted_at'];

    /**
     * Get all of the comment's reactions.
     */
    // public function reactions()
    // {
    //     return $this->morphMany(Reaction::class, 'reactionable');
    // }

    public function posts(){
        return $this->morphedByMany(Post::class, 'commentable');
    }

    public function comments(){
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function comment(){
        return $this->morphByMany(Comment::class, 'commentable');
    }


    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allComments()
    {
        return CommentResource::collection(Comment::all()->sortDesc());
    }

    /**get single Function */
    public function getComment($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['Error' => 'Comment not Found'], 404);

        return new CommentResource($comment);
    }

    /**Edit Function */
    public function editComment($request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['Error' => 'Sorry! Comment not Found'], 404);

        $comment->update([
            'body' => $request->body,
        ]);

        return new CommentResource($comment);
    }

    /**Delete Function */
    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $comment->destroy($commentId);
        return response()->json(['Hello! Report deleted'], 200);
    }



    /**Assign Comment to post  */
    public function commentToPost($request, $postId)
    {
        $post = Post::find($postId);
        if (!$post)
            return response()->json(['Error' => 'Sorry! Comment not found'], 404);

        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }
        
        $comment = Comment::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);

        $comment->posts()->attach($post);

        return new CommentResource($comment);
    }

    /**Assign Comment to comment  */
    public function commentToComment($request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment)
            return response()->json(['Error' => 'Sorry! Comment not found'], 404);

        $validator = Validator::make($request->all(), [
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        $newComment = Comment::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,

        ]);

        $newComment->comments()->attach($comment);

        return new CommentResource($newComment);
    }
}
