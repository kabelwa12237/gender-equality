<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**Controller */
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllComments()
    {
        //
        return $this->comment->allComments();
    }

 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function getSingleComment($commentId)
    {
        return $this->comment->getComment($commentId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function editSingleComment(Request $request, $commentId)
    {
        //
        return $this->comment->editComment($request, $commentId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function deleteSingleComment($commentId)
    {
        //
        return $this->comment->deleteComment($commentId);

    }

         /**
      * Method for assign comment to post.
      */
      public function commentPost(Request $request, $postId){
        return $this->comment->commentToPost($request, $postId);
    }

           /**
      * Method for assign comment to comment.
      */
      public function commentComment(Request $request, $commentId){
        return $this->comment->commentToComment($request, $commentId);
    }
}
