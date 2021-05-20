<?php

namespace App\Models;

use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    public function reactions(){
      return $this->morphToMany(Reaction::class, 'reactionable'); 
  }

  public function comments(){
    return $this->morphToMany(Comment::class, 'commentable'); 
}

    /**
     * variables
     */
    protected $fillable=['body'];
    protected $dates=["deleted_at"];

    /**
     * functions to get,edit,delete postd
     */
    public function allPosts(){
        return PostResource::collection(Post::all());
        }

        /**
         * function to get specific post
         */

     public function getPost($postId){
         $post=Post::find($postId);
         if(!$post)
            return response()->json(['message'=>"post does not exist"]);
            return new PostResource($post);
     }

     public function editPost($request,$postId){
         $post=Post::find($postId);
         if(!$post)
         return response()->json(['message'=>"post does not exist"]);
         $post->update([
            'body'=>$request->body,
            ]);
            return new PostResource($postId);
         }
      public function deletePost($postId) {
        $post=Post::find($postId);
        if(!$post)
        return response()->json(['message'=>"post does not exist"]);
        $post->destroy($postId);
        return response()->json(['message'=>"post deleted successfully"]);
          }

      public function createPost($request){
        $validator=Validator::make($request->all(), ['body'=>'required']);

         if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);
            
            $post=new Post();
            $post->body=$request->body;
            $post->save();
       
            /**
             * check for file media
             */
            if($request->hasFile('media')){
              $post
                ->addMedia($request->file('media'))
                ->preservingOriginal()
                ->toMediaCollection();
               }
        return new PostResource($post);

      }       

}
