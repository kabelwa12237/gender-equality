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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions(){
        return $this->morphMany(Reaction::class, 'reactionable'); 
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'commentable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'commentable');
    }

   // public function comment(){
     //   return $this->morphToMany(Comment::class, 'commentable'); 
  //  }


    protected $fillable=['body','user_id'];
    protected $dates=['deleted_at'];

    /**
     * methods to get all comments
     */

    public function allComments(){
        return CommentResource::collection(Comment::all());
    }
    
    /**
     * methods to get a specific comments
     */

    public function getComment($commentId){
        $comment=Comment::find($commentId);
        if(!$comment)
           return response()->json(['message'=>"comment does not exist"]);
           return new CommentResource($comment);
    }
    /**
     * methods to get all comments
     */
    
    public function editComment($request,$commentId){
        $comment=Comment::find($commentId);
        if(!$comment)
        return response()->json(['message'=>"comment does not exist"]);
        $comment->update([
           'body'=>$request->body,
           ]);
           return new CommentResource($commentId);
    }
    public function deleteComment($commentId) {
        $comment=Comment::find($commentId);
        if(!$comment)
        return response()->json(['message'=>"comment does not exist"]);
        $comment->destroy($comment);
        return response()->json(['message'=>"comment deleted successfully"]);
          }

         /**
          * assign comment to a post
         */

    public function commentToPost($request,$postId)
    {
           $post = Post::find($postId);
           if(!$post)
            return response()->json(['message'=>"post does not exist"]);

            $validator=Validator::make($request->all(),
            ['body'=>'required']); 

            if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);

            $comment = new Comment();
            $comment->body=$request->body;
            $comment->user_id=auth()->user()->id;
            $comment->save();
            $comment->posts()->attach($post);
            return new CommentResource($comment);

        }
    /**
     * Assign comment to comment
     */
    public function commentToComment($request,$commentId)
    {
       $comment = Comment::find($commentId);
       if(!$comment)
        return response()->json(['error'=>"Sorry! comment does not exist"],404);

        $validator=Validator::make($request->all(),
            ['body'=>'required']); 

            if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);

            $newComment = new Comment();
            $newComment->body=$request->body;
            $newComment->user_id=auth()->user()->id;
            $newComment->save();
            $newComment->comments()->attach($comment); 
         return new CommentResource($newComment);
}

}
