<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private  $post;

    public function __construct()

    {
        $this->post = new Post();
        // $this->middleware('auth:api', ['except' => ['login']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->post->allPosts();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        return $this->post->postPost($request);
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $postId)
    {
        return $this->post->getPost($postId);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request ,$postId)
    {
        return $this->post->editPost($request,$postId);
    }

    
   


    public function delete($postId)
    {
        return $this->post->deletePost($postId);
    }

}

