<?php

namespace App\Models;

use App\Http\Resources\ReportResource;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**variable */
    protected $fillable = ['body', 'latitude', 'longitude'];
    protected $dates = ['deleted_at'];


    /**
     * 
     * Get all of the users that are assigned this report.
     */
    public function users()
    {
        return $this->morphedByMany(user::class, 'reportable');
    }

    /**
     * Get all of the organization that are assigned this report.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    public function allReports()
    {
        return  ReportResource::collection(Report::all());
    }

    /**function for showing one report */

    public function getReport($reportId)
    {
        $report = Report::find($reportId);
        if (!$reportId)
            return response()->json(['message' => 'PAGE NOT FOUND']);
        return new ReportResource($report);
    }


    /**function for editing */
    public function editReport($request, $reportId)
    {

        $report = Report::find($reportId);

        if (!$reportId)
            return response()->json(['message' => 'NOT FOUND']);

        /**editing */

        $report->update(['body' => $request->body, 'longitude' => $request->longitude, 'latitude' => $request->latitude]);
        return new ReportResource($report);
    }

    /** DELETING FUNCTION  */

    public function deleteReport($reportId)
    {
        $reportId = Report::find($reportId);

        if (!$reportId)
            return response()->json(['message' => ' TO BE DELETED ID NOT FOUND']);

        /**DELETING */

        $reportId->delete();
        return response()->json(['message' => 'DELETED SUCCESSFUL']);
    }

    public function postOrganization($request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'


        ]);

        $report = new Report();

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 300);
        Report::create([

            'body' => $request->body,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude

        ]);
        return new ReportResource($report);
    }


    public function assignReportToOrganization($reportId, $organizationId)
    {

        $report = Report::find($reportId);
        if (!$reportId)
            return response()->json(['message' => 'report not found']);


        $organization = Organization::find($organizationId);
        if (!$organizationId)
            return response()->json(['message'=>'organization not found']);


        $report->organizations()->attach($organization);
        return new ReportResource($report);
    }
}
