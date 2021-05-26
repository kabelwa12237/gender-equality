<?php

namespace App\Listeners;

use App\Events\ReportSubmitted;
use App\Models\Organization;
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
        $organization = new Organization();
        $organization = Organization::find(1);
        if(!$organization){
          return response()->json(["message"=>"Organization does not exist"]);
        }
        $event->report->organizations()->attach($organization);
    }
}
