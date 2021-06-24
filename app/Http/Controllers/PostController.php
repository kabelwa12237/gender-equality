<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**Constructor */
    private $post;

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['index']]);
        $this->post = new Post();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPosts($limit)
    {
        //
        return $this->post->allPosts($limit);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postSinglePost(Request $request)
    {
        return $this->post->postPost($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function getSinglePost($postId)
    {
        //
        return $this->post->getPost($postId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function editSinglePost(Request $request, $postId)
    {
        //
        return $this->post->editPost($request, $postId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function deleteSinglePost($postId)
    {
        return $this->post->deletePost($postId);
    }
}
