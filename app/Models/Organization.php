<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Database\Seeders\OrganizationSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OpenSSLCertificateSigningRequest;

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
        return $this->morphToMany(Report::class, 'reportable');
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
        return  response()->json(['organization  deleted ']);
    }



    public function postOrganization($request)
    {


        $validator = Validator::make($request->all(), ['name' => 'required|max:5', 'type' => 'required', 'contact' => 'required', 'address' => 'required', 'latitude' => 'required', 'longitude' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);
        }
        //first way to add
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->type = $request->type;
        $organization->contact = $request->contact;
        $organization->address = $request->address;
        $organization->latitude = $request->latitude;
        $organization->longitude = $request->longitude;
        $organization->save();
        return new  OrganizationResource($organization);
        // return response()->json(['organization' => $organization], 201);
    }

    //second way of add  

    //Organization::create(['name'=>'required->name', other required])
    //return new OrganizationResource($request);
    //this create method it save automatic
}
