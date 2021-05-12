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
      * variables
      */
     protected $fillable = ['name', 'type', 'contact', 'latitude', 'longitude'];
     protected $dates = ['deleted_at'];

     /**
      * relationship
      */

     /**shows the relations btn userd snd report using intermeadite table 'rechable'
      * this organization morphtomany reports thru reportables
      */

     public function reports()
     {
          return $this->morphToMany(Report::class, 'reportable');
     }

     /**function for pulling data from database */
     public function allOrganizations()
     {
          return OrganizationResource::collection(Organization::all());
     }

     public function getOrganization($organizationId)
     {

          $organization = Organization::find($organizationId);
          if (!$organization)
               return response()->json(['message' => 'PAGE NOT FOUND']);
          return new OrganizationResource($organization);
     }

     /**function of editing */
     public function editOrganization($request, $organizationId)
     {
          $organization = Organization::find($organizationId);
          if (!$organization) return response()->json(['message' => 'PAGE NOT FOUND']);


          /**editing */
          $organization->update(['name' => $request->name]);
          return new OrganizationResource($organization);
     }

     public function deleteOrganization($organizationId)
     {

          $organization = Organization::find($organizationId);
          if (!$organization)
               return response()->json(['message' => 'DELETED ID NOT FOUND']);
          $organization->delete();
          return response()->json(['deleted successfully']);
     }
}
