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
    public function index()
    {
        //
        return $this->reaction->allReactions();
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
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show($reactionId)
    {
        //
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
        //
        return $this->reaction->editReaction($request ,$reactionId);
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
    public function destroy(Request$request, $reactionId)
    {
        //
        return $this->reaction->deleteReaction($request ,$reactionId);
    }


    public function post(Request $request)
    {
        //
        return $this->reaction->postReaction($request);
    }

    public function assignReactionToPost($reactionId,$postId)
    {
        return $this->reaction->assignReactionToPost($reactionId,$postId); 
    }

    public function assignReactionToComment($reactionId,$commentId)
    {
        return $this->reaction->assignReactionToComment($reactionId,$commentId); 
    }
}
