<?php

namespace App\Models;

use App\Http\Controllers\OrganizationController;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\ReportResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

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
            'longitude'=>'required',
            

        ]);


        $report=new Report();

        if($validator->fails())
            return response()->json(['error'=>$validator->errors()],300);
        Report::create([
            'body'=>$request->body,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            
        ]);
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
