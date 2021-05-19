<?php

namespace App\Models;

use App\Http\Resources\CommentResource;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['body'];
    protected $dates = ["deleted at"];


    //relationships
    public function reaction()
    {
        return $this->morphToMany(Reaction::class, 'reactionable');
    }

    public function comment()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'commentable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'commentable');
    }





    //function za kufetch data from db

    public function allComments()
    {

        return CommentResource::collection(Comment::all());
    }

    public function getComment($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) return response()->json(["message" => "post not found"]);
        return new CommentResource($comment);
    }

    public function editComment($request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) return response()->json(["message" => "comment not found"]);

        //start editing
        $comment->update(['body' => $request->body]);

        return new CommentResource($comment);
    }


    public function deleteComment($request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) return response()->json(["message" => "comment not found"]);

        $comment->delete($commentId);
        return response()->json(["message" => "comment deleted successfully"]);
    }



    public function assignCommentToPost($request, $postId)
    {
        $post = Post::find($postId);
        if (!$post) return response()->json(["message" => "post not found"], 404);


        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 300);
        }

        $comment = new Comment();
        $comment->body = $request->body;


        $comment->save();
        return new CommentResource($comment);

        $comment->posts()->attach($post);
        return new CommentResource($comment);
    }


    public function assignCommentToComment($request, $commentId)
    {

        $comment = Comment::find($commentId);
        if (!$comment) return response()->json(["message" => "comment not found"]);

        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 300);
        }

        $comment = new Comment();
        $comment->body = $request->body;


        $comment->save();
        return new CommentResource($comment);


        $comment->comments()->attach($comment);
        return new CommentResource($comment);
    }
}
