<?php

namespace App\Models;

use App\Http\Resources\PostsResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Posts extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['body'];
    protected $dates = ['deleted_at'];

    //relation



    public function Reaction()
    {
        return $this->morphToMany(Reactions::class, 'reactionable');
    }



    public function Comments()
    {
        return $this->morphToMany(Comments::class, 'commentable');
    }

    public function allPosts()
    {
        return PostsResource::collection(Posts::all());
    }


    public function singleposts($postId)
    {
        $post = Posts::find($postId);

        if (!$post) {
            return response()->json(['error' => 'post not found'], 404);
        }

        return new  PostsResource($post);
    }

    public function addPost($request)
    {

        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);
        }
        //first way to add
        $post = new Posts();
        $post->body = $request->body;
        $post->save();

        if ($request->hasFile('media')) {
            $post

                ->addMedia($request->file('media'))
                ->toMediaCollection();

        
        }

        return new PostsResource($post);


    }

    public function editpost($request, $postId)
    {
        $post
            = Posts::find($postId);

        if (!$post)
            return  response()->json(['error' => 'post not found'], 404);


        ///edit function
        $post->update([
            'body' => $request->body,


        ]);

        return new PostsResource($post);
    }

    public function deletePost($postId)
    {
        $post
            = Posts::find($postId);

        if (!$post)



            return
                response()->json(['error' => 'post not found'], 404);

        $post->destroy($postId);
        return  response()->json(['post  deleted ']);
    }
}
