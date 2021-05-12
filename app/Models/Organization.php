<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * These are variables
     * Business logic 
     */
    protected $fillable=[
        'name','type','contact','latitude','longitude','address'];
    protected $dates=["deleted_at"];

    /**
     * NOW we create ralationships between report and an organization
     
     */

    public function reports(){
        return $this->morphToMany(Report::class, 'reportable'); 
    }
     
    /**
     
     
     * Business logic::retrieve data from database::getting data from the database 
     * organizations refers to data from organization
     */
    public function allOrganizations(){
        return OrganizationResource::collection(Organization::all());
        
    }

    //method to display a specific organization
    public function getOrganization($organizationId){
        $organization=Organization::find($organizationId);
        if(!$organization){
            return response()->json(['message'=>"organization does not exist"]);

    }
        return new OrganizationResource($organization);
        
    }
    public function editOrganization($request,$organizationId){
        $organization=Organization::find($organizationId);
        if(!$organization)
            return response()->json(['message'=>"organization does not exist"]);

    // here we found and start editing
        $organization->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'contact'=>$request->contact,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'address'=>$request->address
            ]);
        return new OrganizationResource($organizationId);
        
    }

    public function deleteOrganization($organizationId){
        $organization=Organization::find($organizationId);
        if(!$organization)
            return response()->json(['message'=>"organization does not exist"]);

    $organization->destroy($organizationId);
        return response()->json(["message"=>"organization deleted successfully"]);
        
    }

}
