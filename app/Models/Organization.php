<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    /**
     * variables
     * 
     */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'type', 'contact', 'latitude', 'longitude', 'contact']; //this
    protected $dates = ['deleted_at'];

    /**
     * Relationship
     * writing relationship of the organization
     */
    public function reports()
    {
        return $this->morphToMany(Report::class, 'reportable');
    } //shows the relationship of organization and report using intermediate table reportables


    /**
     * operations
     */
    //function to pull data from database
    public function allOrganizations()
    {
        return OrganizationResource::collection(Organization::all());
    }

    //getting one organazation and condition when the call is not present in the DB
    public function getOrganization($organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization)
            return response()->json(['error' => 'id not found']);
        return new OrganizationResource($organization);
    }

    //function of edit a single organazation
    public function editOrganization($request, $organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization)
            return response()->json(['error' => 'edit not found']);
            //update 
        $organization->update([
            'name' => $request->name
        ]);
        return new OrganizationResource($organization);
    }

    //function of deleting a single organazation
    public function deleteOrganization($organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization)
            return response()->json(['error' => 'deleted id not found']);
            //update 
        $organization->delete();

        return response()->json(['deleted succsesful']);
    
    }


}
