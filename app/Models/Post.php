<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;


class Post extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    /**
     * variable
     */
       protected $fillable = [
           "body"
       ];
       protected $dates = ["deleted_at"];
   
    /**
     * relationships
     */
    public function comments(){
      return $this->morphToMany(Comment::class,'commentable');
    }
    public function reactions(){
      return $this->morphMany(Reaction::class,'reactionable');
    }
    public function user(){
      return $this->belongsTo(User::class);
    }



     /**
  * functions or operation
  */
  //get all posts fn
  public function allPosts(){
    return PostResource::collection(Post::all());
  }

   //get a specific post fn
   public function getPost($postId){
    $post = post::find($postId);
    if(!$post){
      return response()->json(['message'=>'post not found']);
    }
   return new postResource($post);
 }

    //create post fn
  public function createPosts($request){
    $validator = Validator::make($request->all(),
      [
        'body'=>'required',
      ]
    );

    if($validator->fails())
    return response()->json(['error'=>$validator->errors()],300);
    $post = new Post();
    $post->body = $request->body;
    
    auth()->user()->posts()->save($post);

    ///check if there is file and add to a media
if($request->hasFile('media_file')){
  $post
   ->addMedia($request->file('media_file'))
   ->preservingOriginal()
   ->toMediaCollection();
}
   return new postResource($post);
  }

  


}
