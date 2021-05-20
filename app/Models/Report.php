<?php

namespace App\Models;

use App\Http\Controllers\OrganizationController;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\ReportResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
;

class Report extends Model  implements HasMedia

{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

/**
 * variables
 */

protected $fillable=['body','latitude','longitude'];
protected $dates=['deleted_at'];



    public function users()
    {
        return $this->morphedByMany(User::class, 'reportable');
    }


    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    public function allReports(){
        return ReportResource::collection(Report::all());
    }

    public function getReport($reportId){
        $report=Report::find($reportId);
        if(!$report){
            return response()->json(['message'=>"report does not exist"]);

            }
        return new ReportResource($report);
        
    }

    public function editReport($request,$reportId){
        $report = Report::find($reportId);
        if(!$report)
            return response()->json(['message'=>"report does not exist"]);

    // here we found and start editing
        $report->update([
            'body'=>$request->body,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            ]);
        return new ReportResource($reportId);
        
    }

    public function deleteReport($reportId){
        $report=Report::find($reportId);
        if(!$report)
            return response()->json(['message'=>"report does not exist"]);

    $report->destroy($reportId);
        return response()->json(["message"=>"report deleted successfully"]);
        
    }
    public function postReport($request){
        $validator=Validator::make($request->all(),
        [
            'body'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
              ]);

      if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);

            $report=new Report();
            $report->body=$request->body;
            $report->latitude=$request->latitude;
            $report->longitude=$request->longitude;
            $report->save();
            /**
             * Checking if file exists
             */
        if($request->hasFile('media_file')){
           $report
             ->addMedia($request->file('media_file'))
             ->preservingOriginal()
             ->toMediaCollection();
            }
        return new ReportResource($report);
    }

    public function assignReportToOrganization($reportId,$organizationId){
            $report = Report::find($reportId);
        if(!$report){
            return response()->json(['message'=>"report does not exist"]);}
            

           $organization = Organization::find($organizationId);
        if(!$organization){
            return response()->json(['message'=>"organization does not exist"]);}
        

        $report->organizations()->attach($organization);
        return new ReportResource($report);

    }

}
