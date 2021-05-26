<?php

namespace App\listeners;

use App\Events\ReportSubmitted;
use App\Models\Organization;
use Database\Seeders\OrganizationSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReportToOrganization
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReportSubmitted  $event
     * @return void
     */
    public function handle(ReportSubmitted $event)
    {
        
        $organization = Organization::find(1);
        if(!$organization){
            return response()->json(['message'=>"organization does not exist"]);}
        

        $event->report->organizations()->attach($organization);
    }
}
