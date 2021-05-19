<?php

namespace App\Http\Controllers;

use App\Models\Reactions;
use Illuminate\Http\Request;

class ReactionsController extends Controller
{
    private $reaction;

    public function __construct()
    {
        $this->reaction = new Reactions();
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
     * @param  \App\Models\Reactions  $reactions
     * @return \Illuminate\Http\Response
     */
    public function show($reactionId)
    {
        return $this->reaction->singleReaction($reactionId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reactions  $reactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $reactionId)
    {
        return $this->reaction->editReaction($request, $reactionId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reactions  $reactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reactions $reactions)
    {
        //
    }

    public function assignment($reactionId, $postId)
    {

        return $this->reaction->assignReactionToPost($reactionId,$postId);
    }

    public function assign($reactionId, $commentId)
    {

        return $this->reaction->assignReactionToComment($reactionId,$commentId);
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reactions  $reactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($reactionId)
    {
        return $this->reaction->deleteReaction($reactionId);
    }
}
