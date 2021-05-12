<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Database\Seeders\OrganizationSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;

    //variables

    protected $fillable = ['name', 'type', 'contact', 'address', 'latitude', 'longitude'];
    protected $dates = ['deleted_at'];

    //relationship 

    public function Reports()
    {
        return $this->morphedToMany(Report::class, 'reportable');
    }

    //operations or busnesslogic
    public function allOrganizations()
    {
        return OrganizationResource::collection(Organization::all());
    }

    public function getOrganization($organizationId)
    {
        $organization
            = Organization::find($organizationId);

        if (!$organization)



            return
                response()->json(['error' => 'organization  not found'], 404);;


        return new  OrganizationResource($organization);
    }


    public function editOrganization($request, $organizationId)
    {
        $organization
            = Organization::find($organizationId);

        if (!$organization)
            return  response()->json(['error' => 'organization  not found'], 404);


        ///edit function
        $organization->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'type' => $request->type,
           'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            
        ]);


        return new  OrganizationResource($organization);
    }

    public function deleteOrganization($organizationId)
    {
        $organization
            = Organization::find($organizationId);

        if (!$organization)



            return
                response()->json(['error' => 'organization  not found'], 404);

$organization->destroy($organizationId);
        return  response()->json([ 'organization  deleted ']);

    }
}
