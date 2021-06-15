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


    /**
     * Variables
     */
    protected $fillable = ['title', 'body'];
    protected $dates = ['deleted_at'];

    /**
     * Relationship presented by function
     */

    /**
     * Get all of the post's reactions.
     */

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    /**
     * Get the comments for the blog post.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allPosts($limit)
    {

        return PostResource::collection(Post::all()->take($limit)->sortDesc());
    }

    /**get single Function */
    public function getPost($postId)
    {
        $post = Post::find($postId);
        if (!$post)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        return new PostResource($post);
    }

    /**Edit Function */
    public function editPost($request, $postId)
    {
        $post = Post::find($postId);
        if (!$post)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $post->update([
            'body' => $request->body,
        ]);

        return new PostResource($post);
    }

    /**Delete Function */
    public function deletePost($postId)
    {
        $post = Post::find($postId);
        if (!$post)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $post->destroy($postId);
        return response()->json(['Hello! Report deleted'], 200);
    }

    /**Post Function */
    public function postPost($request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        /**create post */
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;

        auth()->user()->posts()->save($post);

        /**add media file to the post */
        if ($request->hasFile('media')) {
            $post
                ->addMedia($request->file('media'))
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return new PostResource($post);
    }
}
