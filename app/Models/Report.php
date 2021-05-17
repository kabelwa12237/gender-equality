<?php

namespace App\Models;

use App\Http\Resources\Reportresource;
use App\Http\Resources\ReportResource as ResourcesReportResource;
use App\Http\Resources\ReportResources;
use App\Http\Resources\Reportsource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Psy\Command\EditCommand;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['body', 'latitude', 'longitude'];
    protected $dates = ['deleted_at'];

    public function Organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    public function User()
    {
        return $this->morphedByMany(User::class, 'reportable');
    }



    public function getreport($reportId)
    {
        $report = Report::find($reportId);

        if (!$report) {
            return response()->json(['error' => 'report not found'], 404);
        }

        return new  ReportResources($reportId);
    }


    public function getReports()
    {

        return ReportResources::collection(Report::all());
    }



    public function deleteReport($reportId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['error' => 'report not found']);

        $report->destroy($reportId);
        return response()->json(['error' => 'report deleted successfully'], 200);
    }

    public function postReport($request)
    {

        $validator = Validator::make($request->all(), ['body' => 'required', 'latitude' => 'required', 'longitude' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 404);
        }

        $report = new Report();
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->body = $request->body;
        $report->save();
        return new  ReportResources($report);
    }

    // public  function editReport($request, $reportId)
    // {

    //     $report = Report::find($reportId);
    //     if (!$report)
    //         return response()->json(['error' => 'report not found']);


    //     $report->update([
    //         'body' => $request->body,
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //     ]);
    //     return new  ReportResources($reportId);
    // }


    public function updateReport($request, $reportId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['error' => 'report not found']);

        $report->update([
            'body' => $request->body,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        return new ReportResources($report);
    }


    public function asignReportToOrganization($reportId,$organizationId){
$report= Report::find($reportId);
if(!$report)
return response()->json(['error'=>'report does not found']);



$organization=Organization::find($organizationId);
if(!$organization)

return response()->json(['error'=>'organization does not found']);

$report->Organizations()->attach($organization);
return new ReportResources($report);
    }
}
