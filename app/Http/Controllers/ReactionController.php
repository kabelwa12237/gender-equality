<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{

      /**Controller */
      private $reaction;

      public function __construct()
      {
          $this->reaction = new Reaction();
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->reaction->allReactions();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->reaction->postReaction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show($reactionId)
    {
        return $this->reaction->getReaction($reactionId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $reactionId)
    {
        return $this->reaction->editReaction($request, $reactionId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($reactionId)
    {
        return $this->reaction->deleteReaction($reactionId);
    }

        /**
      * Method for assign reaction to post.
      */
      public function reactPost($reactionId, $postId){
        return $this->reaction->reactToPost($reactionId, $postId);
    }

            /**
      * Method for assign reaction to comment.
      */
      public function reactComment($reactionId, $commentId){
        return $this->reaction->reactToComment($reactionId, $commentId);
    }
}
