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
    protected $fillable = ['body'];
    protected $dates = ['deleted_at'];

    /**
     * Relationship presented by function
     */

    /**
     * Get all reactions for the Comment 
     */

    public function reactions()
    {
        return $this->morphToMany(Reaction::class, 'reactionable');
    }


    /**
     * Get all posts for the Comment 
     * */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'commentable');
    }

    /**
     * Get all comments for the Comment 
     * */
    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'commentable');
    }

    /**
     * Get all comment for the Comment 
     * */
    public function comment()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allComments()
    {
        return CommentResource::collection(Comment::all());
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
        if ($comment)
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
            'body' => $request->body
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
            'body' => $request->body
        ]);

        $newComment->comments()->attach($comment);

        return new CommentResource($newComment);
    }
}
