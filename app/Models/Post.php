<?php

namespace App\Models;

use App\Http\Resources\PostResource;
use App\Http\Resources\ReactionResource;
use Illuminate\Bus\UpdatedBatchJobCounts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['body'];
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }


public function reactions(){
    return $this->morphToMany(Reaction::class,'reactionables');


}



    public function allPosts()
    {
        return PostResource::collection(Post::all());
    }
    public function getPost( $postid)
    {
        $post = Post::find($postid);
        if (!$post)
            return response()->json(['message' => 'POST ONT FOUND']);
        return new PostResource($postid);
    }
    public function editPost($request ,$postid)
    {
        $post = Post::find($postid);
        if (!$post)
            return response()->json(['message' => 'POST ONT FOUND']);
        /***EDITING */
        $post->update(['body'=>$request->body]);
        return new PostResource($post);
    }

    public function deletePost($postId)
    {

         $post = Post::find($postId);
         if (!$post)
              return response()->json(['message' => 'DELETED ID NOT FOUND']);

              /**deleting */
         $post->delete();
         return response()->json(['deleted successfully']);
    }
    public function postPost($request)
    {
         $validator = Validator::make($request->all(), [
              'body' => 'required',
             
         ]);

       

         if ($validator->fails())
              return response()->json(['error' => $validator->errors()], 300);
        $post= new Post();
        $post->body = $request->body;
        
        
         return new PostResource($post);
    }
}
