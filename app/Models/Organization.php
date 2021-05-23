<?php

namespace App\Models;

use App\Http\Resources\OrganizationResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;
 /**
  * variable
  */
    protected $fillable = [
        "name","type","contact","latitude","longitude","address"
    ];
    protected $dates = ["deleted_at"];

 /**
  * relationships
  */
  //get relatnshp f reprts to organization
public function reports(){
    return $this->morphToMany(Report::class,'reportable');
}



 /**
  * functions or operation
  */

  //get allOrga fn
  public function allOrganizations() {
    return OrganizationResource::collection(Organization::all());
   } 

//get a specific org fn
   public function getOrganization($organizationId){
      $organization = Organization::find($organizationId);
      if(!$organization){
        return response()->json(['message'=>'organization not found']);
      }
     return new OrganizationResource($organization);
   }

   //post org fn
   public function postOrganization($request){
   
    $validator = Validator::make($request->all(),
      [
        'name'=>'required',
        'type'=>'required',
        'contact'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
         'address'=>'required'
      ]
    );
    if($validator->fails())
    return response()->json(['error'=>$validator->errors()],300);
    // Organization::create([
    //   'name'=>$request->name,
    //   'type'=>$request->type,
    //   'contact'=>$request->contact,
    //   'latitude'=>$request->latitude,
    //   'longitude'=>$request->longitude,
    //    'address'=>$request->address
    // ]);
    $organization = new Organization();
    $organization->name = $request->name;
    $organization->type = $request->type;
    $organization->contact= $request->contact;
    $organization->latitude= $request->latitude;
    $organization->longitude= $request->longitude;
    $organization->address= $request->address;
    $organization->save();
   return new OrganizationResource($organization);
 }
 

//edit org fn
   public function editOrganization($request,$organizationId){
    $organization = Organization::find($organizationId);
    if(!$organization)
      return response()->json(['message'=>'organization not found']);
    
    $organization->update(
      [
        'name'=>$request->name,
        'type'=>$request->type,
        'contact'=>$request->contact,
        'latitude'=>$request->latitude,
        'longitude'=>$request->longitude,
         'address'=>$request->address
      ]
    );
   return new OrganizationResource($organization);
 }

 //delete org fn
 public function deleteOrganization($organizationId){
  $organization = Organization::find($organizationId);
  if(!$organization){
    return response()->json(['message'=>'organization not found']);
  }
  $organization->delete($organizationId);
 return response()->json(['message'=>'organization deleted successfully']);
}
   

 
}


















/**
 * madini
 */
//    response()->json([
//     'organizations'=>Organization::all()
// ]);