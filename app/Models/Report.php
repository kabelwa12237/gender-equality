<?php

namespace App\Models;

use App\Events\ReportSubmitted;
use App\Http\Resources\ReportResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    /**
     * variable
     */
       protected $fillable = [
           "body","latitude","longitude"
       ];
       protected $dates = ["deleted_at"];
   
   /**
    * relationships
    */

public function users(){
    return $this->morphedByMany(User::class,'reportable');
}

  public function organizations(){
    return $this->morphedByMany(Organization::class,'reportable');
}
  
    /**
     * functions or operations
     */

  //get all Report fn
  public function allReports() {
    return ReportResource::collection(Report::all());
   } 

//get a specific Report fn
   public function getReport($reportId){
      $report = Report::find($reportId);
      if(!$report){
        return response()->json(['message'=>'Report not found']);
      }
     return new ReportResource($report);
   }

   //post Report fn
   public function postReport($request){
   
    $validator = Validator::make($request->all(),
      [
        'body'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
      ]
    );

    if($validator->fails())
    return response()->json(['error'=>$validator->errors()],300);
    // Organization::create([
    //   'body'=>$request->body,
    //   'latitude'=>$request->latitude,
    //   'longitude'=>$request->longitude,
    // ]);
    $report = new Report();
    $report->body = $request->body;
    $report->latitude = $request->latitude;
    $report->longitude = $request->longitude;
    $report->save();
    event(new ReportSubmitted($report));
    ///check if there is file and add to a media
if($request->hasFile('media_file')){
  $report
   ->addMedia($request->file('media_file'))
   ->preservingOriginal()
   ->toMediaCollection();
}
   return new ReportResource($report);
 }
 

//edit Report fn
   public function editReport($request,$reportId){
    $report = Report::find($reportId);
    if(!$report)
      return response()->json(['message'=>'Report not found']);
    
    $report->update(
      [
        'body'=>$request->body,
        'latitude'=>$request->latitude,
        'longitude'=>$request->longitude,
      ]
    );
   return new ReportResource($report);
 }

 //delete Report fn
 public function deleteReport($reportId){
  $report = Report::find($reportId);
  if(!$report){
    return response()->json(['message'=>'Report not found']);
  }
  $report->delete($reportId);
 return response()->json(['message'=>'Report deleted successfully']);
}

 //assign Report to organization  fn
public function assignReportToOrganization($reportId,$organizationId){
  $report = Report::find($reportId);
  if(!$report){
    return response()->json(['message'=>"report does not exist"]);
  }
  $organization = Organization::find($organizationId);
  if(!$organization){
    return response()->json(["message"=>"Organization does not exist"]);
  }
  $report->organizations()->attach($organization);
  return new ReportResource($report);
}

                                 
   
}
