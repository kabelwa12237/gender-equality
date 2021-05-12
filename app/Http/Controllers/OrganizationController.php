<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    //  private Organization $organization;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //the variable helps to resolve repetition in coding
    private $organization;

    public function __construct()
    {
        $this->organization = new Organization();
    }

    //this is to get all organizations
    public function index()
    {
        return $this->organization->allOrganizations();
    }




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
    public function show($organizationId)
    {
        return $this->organization->getOrganization($organizationId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    //function that allows to eit one organazation
    public function edit(Request $request, $organizationId)
    {
        return $this->organization->editOrganization($request, $organizationId);
    }

    //function that allows to delete an organization
    public function delete($organizationId)
    {
        return $this->organization->deleteOrganization($organizationId);
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
    public function destroy(Organization $organization)
    {
        //
    }
}
