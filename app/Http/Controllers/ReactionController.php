<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Database\Seeders\ReactionSeeder;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
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
        $this->reaction->allReactions();
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
        // return $this->reaction->createReaction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reactionId)
    {
        return $this->reaction->getReaction($reactionId);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$reactionId)
    {
        return $this->reaction->editReaction($request,$reactionId);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reactionId)
    {
        return $this->reaction->editReaction($request,$reactionId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reactionId)
    {
        return $this->reaction->deleteReaction($reactionId);

    }

    public function attachReactionToPost(Request $request,$postId)
    {
        return $this->reaction->attachReactionToPost($postId,$request);

    }
    public function attachReactionToComment($reactionId,$commentId)
    {
        return $this->reaction->attachReactionToComment($reactionId,$commentId);

    }
}
