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



    protected $fillable = ['body'];
    protected $dates = ["deleted at"];


    public function reaction()
    {
        return $this->morphedToMany(Reaction::class, 'reactionable');
    }

    public function allPosts()
    {
        //return response()->json(['organization'=>Organization::all()]);
        return PostResource::collection(Post::all());
    }

    public function getPost($postId){
        $post = Post::find($postId);
        if (!$post) return response()->json(["message" => "post not found"]);
         return new postResource($post);


    }

    public function editPost($request, $postId)
    {
        $post = Post::find($postId);
        if (!$post) return response()->json(["message" => "post not found"]);

        //start editing
        $post->update(['body' => $request->body]);

        return new PostResource($post);
    }


    public function deletePost($request, $postId)
    {
        $post = Post::find($postId);
        if (!$post) return response()->json(["message" => "post not found"]);

        $post->delete($postId);
        return response()->json(["message" => "post deleted successfully"]);
    }




    public function addPost($request)
    {  
        $validator= Validator::make($request->all(),['body'=>'required',]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],300);
        }

       $post=new Post();
       $post->body=$request->body;


       $post->save();

       if($request->hasFile('media')){
        $post
        ->addMedia($request->file('media'))
        ->toMediaCollection();
       }

       return new PostResource($post);



    }

    

}
