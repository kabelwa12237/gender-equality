<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;


/** controller it used to connect models and views by using API */
class OrganizationController extends Controller
{
    private $organization;

    public function __construct()
    {
        $this->organization = new Organization;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //  
        return $this->organization->allOrganizations();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->organization->postOrganization($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show($organizationId)
    {
        //
        return $this->organization->getOrganization($organizationId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $organizationId)
    {
        //
        return $this->organization->editOrganization($request, $organizationId);
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
    public function destroy($organizationId)
    {
        //
        return $this->organization->deleteOrganization($organizationId);
    }
}
