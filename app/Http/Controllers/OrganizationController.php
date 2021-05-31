<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * creating/declaration Organization variable
     * create a constructor of organization using instance
     */

     private $organization;
    //create a constructor of a model class called or
       public function __construct(){
         //initialization object of a model class
         $this->organization = new Organization();
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllOrganizations()
    {
     return $this->organization->allOrganizations();
      // return response()->json(['organizations'=>Organization::all()]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function getOrganization($organizationId)
    {
        return $this->organization->getOrganization($organizationId);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function editOrganization(Request $request, $organizationId)

    {
    return $this->organization->editOrganization($request,$organizationId);    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function deleteOrganization($organizationId)
    {
        return $this->organization->deleteOrganization($organizationId);
        //
    }
    
    public function postOrganization(Request $request){
        return $this->organization->postOrganization($request);
    }

    
   
}
