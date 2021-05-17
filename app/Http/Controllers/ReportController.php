<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    private $report;

    public function __construct()
    {
        $this->report = new Report();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->report->allReports();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->report->postReport($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($reportId)
    {
        //
        return $this->report->getReport($reportId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $reportId)
    {
        //
        return $this->report->editReport($request, $reportId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($reportId)
    {
        //
        return $this->report->deleteReport($reportId);

    }

     /**
      * Method for assign report to organization.
      */
    public function assignReport($reportId, $organizationId){
        return $this->report->assignReportToOrganization($reportId, $organizationId);
    }
}
