<?php

namespace App\Models;

use App\Events\ReportSubmitted;
use App\Http\Resources\ReportResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    /**
     * Variables
     */
    protected $fillable = ['body', 'latitude', 'longitude', 'media_type'];
    protected $dates = ['deleted_at'];


    /**
     * Get all of the organizations that are assigned this report.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'reportable');
    }

    /**
     * Get all of the users that are assigned this report.
     */
    public function user()
    {
        return $this->morphedByMany(User::class, 'reportable');
    }

    /**
     * Business Logic
     * To pull data from db
     */

    /**get all Function */
    public function allReports()
    {
        return ReportResource::collection(Report::all()->sortDesc());
    }

    /**get single Function */
    public function getReport($reportId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        return new ReportResource($report);
    }

    /**Edit Function */
    public function editReport($request, $reportId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $report->update([
            'body' => $request->body,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return new ReportResource($report);
    }

    /**Delete Function */
    public function deleteReport($reportId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $report->destroy($reportId);
        return response()->json(['Hello! Report deleted'], 200);
    }

    /**Post Function */
    public function postReport($request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 300);
        }

        $report = new Report();
        $report->body = $request->body;
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->media_type = $request->media_type;

        auth()->user()->reports()->save($report);

         

        /**call event */
        event(new ReportSubmitted($report));

        if($request->hasFile('media_file')){
            $report
               ->addMedia($request->file('media_file'))
               ->preservingOriginal()
               ->toMediaCollection();
        }

        return new ReportResource($report);
    }

    /**Assign Reports to organization  */
    public function assignReportToOrganization($reportId, $organizationId)
    {
        $report = Report::find($reportId);
        if (!$report)
            return response()->json(['Error' => 'Sorry! Report not Found'], 404);

        $organization = Organization::find($organizationId);
        if (!$organization)
            return response()->json(['Error' => 'Sorry! Organization not found'], 404);

        $report->organizations()->attach($organization);

        return new ReportResource($report);
    }
}
