<?php

namespace App\Models;

use App\Http\Resources\CommentsResource;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Comments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['body'];
    protected $dates = ['deleted_at'];


    //relation
    public function Reaction()
    {
        return $this->morphToMany(Reactions::class, 'reactionable');
    }

    //relation of comments to post

    public function posts()
    {
        return $this->morphedByMany(Posts::class, 'commentable');
    }
    //relation of comment to comment


    public function comments()
    {
        return $this->morphedByMany(Comments::class, 'commentable');
    }
    //relation of comment 

    public function comment()
    {
        return $this->morphToMany(Comments::class, 'commentable');
    }



    public function allComments()
    {
        return CommentsResource::collection(Comments::all());
    }

    public function singlecomment($commentId)
    {
        $comment = Comments::find($commentId);

        if (!$comment) {
            return response()->json(['error' => 'comment not found'], 404);
        }

        return new  CommentsResource($comment);
    }


    public function editComment($request, $commentId)
    {
        $comment
            = Comments::find($commentId);

        if (!$comment)
            return  response()->json(['error' => 'comment not found'], 404);


        ///edit function
        $comment->update([
            'body' => $request->body,


        ]);

        return new CommentsResource($comment);
    }

    public function deleteComment($commentId)
    {
        $comment
            = Comments::find($commentId);

        if (!$comment)



            return
                response()->json(['error' => 'comment does not exist'], 404);

        $comment->destroy($commentId);
        return  response()->json(['comment deleted successfuly ']);
    }

    public function assignCommentToPost($request, $postId,)
    {
        $post = Posts::find($postId);
        if (!$post)
            return response()->json(['error' => 'post does not found']);

        //add comment to post
        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);



        $comment = new Comments();
        $comment->body = $request->body;
        $comment->save();

        $comment->posts()->attach($post);
        return new CommentsResource($comment);
    }




    public function assignCommentToComment($request, $commentId,)
    {
        $comment = Comments::find($commentId);
        if (!$comment)
            return response()->json(['error' => 'comment does not found']);

        //add comment to comment
        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);
        }

        $newcomment = new Comments();
        $newcomment->body = $request->body;
        $newcomment->save();
        $newcomment->comments()->attach($comment);
        return new CommentsResource($newcomment);
    }
}
