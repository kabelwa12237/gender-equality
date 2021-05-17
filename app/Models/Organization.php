<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class Organization extends Model
{
    // variables
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'type', 'contact', 'latitude', 'longitude', 'address'];
    protected $dates = ["deleted at"];


    //Relationships 
    public function report()
    {
        return $this->morphToMany(Report::class, 'reportable');
    }

    // pulling data from the database
    //get all organization
    public function allOrganization()
    {
        //return response()->json(['organization'=>Organization::all()]);
        return OrganizationResource::collection(Organization::all());
    }

    //function ya kuget a single organization
    public function getOrganization($organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization) return response()->json(["message" => "organization not found"]);
        return new OrganizationResource($organization);
    }
    //function ya kuedit a single organization
    public function editOrganization($request, $organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization) return response()->json(["message" => "organization not found"]);

        //start editing
        $organization->update(['name' => $request->name]);

        return new OrganizationResource($organization);
    }

    //function ya kudelete a single organization
    public function deleteOrganization($organizationId)
    {
        $organization = Organization::find($organizationId);
        if (!$organization) return response()->json(["message" => "organization not found"]);

        //start deleting
        $organization->delete($organizationId);
        return response()->json(["message" => "organization not found"]);
    }


    public function postOrganization($request)
    {  
        $validator= Validator::make($request->all(),['name'=>'required','type'=>'required','contact'=>'required','latitude'=>'required','longitude'=>'required','address'=>'required', ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],300);
        }

       // Organization::crete(['name'=>$request->name,'type'=>$request->type,'contact'=>$request->contact,....])
       $organization=new Organization();
       $organization->name=$request->name;
       $organization->type=$request->type;
       $organization->contact=$request->contact;
       $organization->latitude=$request->latitude;
       $organization->longitude=$request->longitude;
       $organization->address=$request->address;

       $organization->save();

       return new OrganizationResource($organization);



    }
}
