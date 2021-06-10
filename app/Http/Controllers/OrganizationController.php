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

    public function getAllOrganizations()
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
    public function postSingleOrganization(Request $request)
    {
        return $this->organization->postOrganization($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function getSingleOrganization($organizationId)
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
    public function editSingleOrganization(Request $request, $organizationId)
    {
        //
        return $this->organization->editOrganization($request, $organizationId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function deleteSingleOrganization($organizationId)
    {
        //
        return $this->organization->deleteOrganization($organizationId);
    }
}
