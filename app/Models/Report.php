<?php

namespace App\Models;

use App\Http\Resources\ReportResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['body', 'type', 'latitude', 'longitude'];
    protected $dates = ["deleted at"];
    //relationships
    public function users()
    {
        return $this->morphedByMany(User::class, 'reportabble');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    //get all reports
    public function allReports()
    {

        return ReportResource::collection(Report::all());
    }

     //function ya kuget a single report
     public function getReport($reportId)
     {
         $report = Report::find($reportId);
         if (!$report) return response()->json(["message" => "report not found"]);
         return new ReportResource($report);
     }

      //function ya kuedit a single organization
    public function editReport($request, $reportId)
    {
        $report = Report::find($reportId);
        if (!$report) return response()->json(["message" => "Report not found"]);

        //start editing
        $report->update(['body' => $request->body, 'latitude' => $request->latitude, 'longitude' => $request->longitude]);

        return new ReportResource($report);
    }

    public function deleteReport($reportId)
    {
        $report = Report::find($reportId);
        if (!$report) return response()->json(["message" => "report not found"]);

        //start deleting
        $report->delete($reportId);
        return response()->json(["message" => "report deleted successfully"]);
    }

    public function postReport($request)
    {  
        $validator= Validator::make($request->all(),['body'=>'required','latitude'=>'required','longitude'=>'required']);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],300);
        }

       // Organization::crete(['name'=>$request->name,'type'=>$request->type,'contact'=>$request->contact,....])
       $report=new Report();
       $report->body=$request->body;
       $report->latitude=$request->latitude;
       $report->longitude=$request->longitude;

       $report->save();

       return new ReportResource($report);



    }
    //function ya kuasign report to a organizations

    public function assignReportToOrganization($reportId,$organizationId){

        $report = Report::find($reportId);
        if (!$report) return response()->json(["message" => "report not found"]);

        $organization = Organization::find($organizationId);
        if (!$organization) return response()->json(["message" => "organization not found"]);

        $report->organizations()->attach($organization);
        return new ReportResource($report);


    }





}
