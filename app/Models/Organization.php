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
    * Variables
    */
   protected $fillable = ['name', 'type', 'contact', 'address', 'latitude', 'longitude'];

   protected $dates = ['deleted_at'];

   /**
    * Relationship presented by function
    */

   /**Get all reports for the Organization */
   /**reportable is class of table reportables */

   public function Reports()
   {
      return $this->morphToMany(Report::class, 'reportable');
   }

   /**
    * Business Logic
    * To pull data from db
    */
    
    /**get all Function */
   public function allOrganizations()
   {
      return OrganizationResource::collection(Organization::all()->sortDesc());
   }

    /**get single Function */
   public function getOrganization($organizationId)
   {
      $organization = Organization::find($organizationId);
      if (!$organization) 
      return response()->json(['Error' => 'Sorry! Organization not found'], 404);
      return new OrganizationResource($organization);
   }

   /**Edit Function */

   public function editOrganization($request, $organizationId)
   {
      $organization = Organization::find($organizationId);
      if (!$organization)
         return response()->json(['Error' => 'Sorry! Table not found'], 404);

      /**Edit Function */
      $organization->update([
         'name' => $request->name,
         'type' => $request->type,
         'contact' => $request->contact,
         'address' => $request->contact,
         'latitude' => $request->latitude,
         'longitude' => $request->longitude,       
         ]);

      return new OrganizationResource($organization);
   }

      /**Delete Function */

      public function deleteOrganization($organizationId)
      {
         $organization = Organization::find($organizationId);
         if (!$organization)
            return response()->json(['Error' => 'Sorry! Table not found'], 404);
   
         /**Delete Function */
         $organization->destroy($organizationId);
         return response()->json(['Hello! Table deleted'], 200);
      }

       /**Post Function */
       public function postOrganization( $request)
       {
          $validator = Validator::make($request->all(), [
             'name'=> 'required',
             'type'=> 'required',
             'contact'=>'required',
             'address'=>'required',
             'latitude'=>'required',
             'longitude'=>'required'
          ]);
          if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'status'=>false],300);
          }

          $organization=new Organization();
          $organization->name=$request->name;
          $organization->contact=$request->contact;
          $organization->type=$request->type;
          $organization->address=$request->address;
          $organization->latitude=$request->latitude;
          $organization->longitude=$request->longitude;
          $organization->save();

          return new OrganizationResource($organization);
       }

   
}
