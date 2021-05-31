<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    private $reaction;
    public function __construct()
    {
       $this->reaction=new Reaction(); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllReactions()
    {
        return $this->reaction->allReactions();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postReaction(Request $request)
    {
        return $this->reaction->postReaction($request);
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
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function getReaction($reactionId)
    {
        return $this->reaction->getReaction($reactionId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function editReaction(Request $request,$reactionId)
    {
        return $this->reaction->editReaction($request,$reactionId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function deleteReaction($reactionId)
    {
        return $this->reaction->deleteReaction($reactionId);
    }

  public function assignPost(Request $request,$postId){
      return $this->reaction->assignReactionToPost($request,$postId);
  }
  public function assignComment($reactionId,$commentId){
      return $this->reaction->assignReactionToComment($reactionId,$commentId);
  }
}
