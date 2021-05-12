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
      return $this->morphedToMany(Report::class, 'reportable');
   }

   /**
    * Business Logic
    * To pull data from db
    */
    
    /**get all Function */
   public function allOrganizations()
   {
      return OrganizationResource::collection(Organization::all());
   }

    /**get single Function */
   public function getOrganization($organizanationId)
   {
      $organization = Organization::find($organizanationId);
      if (!$organization) 
      return response()->json(['Error' => 'Sorry! Table not found'], 404);
      return new OrganizationResource($organization);
   }

   /**Edit Function */

   public function editOrganization($request, $organizanationId)
   {
      $organization = Organization::find($organizanationId);
      if (!$organization)
         return response()->json(['Error' => 'Sorry! Table not found'], 404);

      /**Edit Function */
      $organization->update(['name' => $request->name]);

      return new OrganizationResource($organization);
   }

      /**Delete Function */

      public function deleteOrganization($organizanationId)
      {
         $organization = Organization::find($organizanationId);
         if (!$organization)
            return response()->json(['Error' => 'Sorry! Table not found'], 404);
   
         /**Delete Function */
         $organization->destroy($organizanationId);
         return response()->json(['Hello! Table deleted'], 200);

   
      
      }

   
}
