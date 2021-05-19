<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;
    public function __construct(){
        $this->comment=new Comment();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




     
    public function index()
    {
        //
        return $this-> comment->allComments();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($commentId)
    {
        //
        return $this-> comment->getcomment($commentId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $commentId)
    {
        return $this-> comment->editcomment($request, $commentId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $commentId)
    {
        //
        return $this-> comment->deletecomment($request, $commentId);
    }

    // public function post(Request $request, $commentId)
    // {
    //     //
    //     return $this-> comment->postcomment($request, $commentId);
    // }



    public function assignCommentToPost(Request $request,$postId)
    {
        return $this->comment->assigncommentToPost($request,$postId); 
    }

    public function assignCommentToComment(Request$request ,$commentId)
    {
        return $this->comment->assigncommentToComment($request,$commentId); 
    }
}
