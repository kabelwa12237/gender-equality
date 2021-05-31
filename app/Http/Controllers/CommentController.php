<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct()
    {
        $this->comment=new Comment();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllComments()
    {
        return $this->comment->allComments();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request)
    {
        return $this->comment->postComment($request);
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
    public function getComment($commentId)
    {
        return $this->comment->getComment($commentId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function editComment(Request $request, $commentId)
    {
        return $this->comment->editComment($request,$commentId);
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
    public function deleteComment($commentId)
    {
        return $this->comment->deleteComment($commentId);
    }
    /**
     * comment to post
     */
    public function commentPost(Request $request,$postId){
        return $this->comment->commentToPost($request,$postId);
    }
    /**
     * comment to comment
     */
    public function commentComment(Request $request,$commentId){
        return $this->comment->commentToComment($request,$commentId);
    }


  
}
