<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
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
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(Reaction $reactionId)
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
    public function destroy(Reaction $reaction)
    {
        //
    }

    
    public function delete($reactionId)
    {
        return $this->reaction->deleteReaction($reactionId);
    }

    public function assignComment($reactionId,$commentId){
        return $this->reaction->assignReactToComment($reactionId,$commentId);    }

        public function assignPost($reactionId,$postId){
            return $this->reaction->assignReactTopost($reactionId,$postId);    }
    
        
}
