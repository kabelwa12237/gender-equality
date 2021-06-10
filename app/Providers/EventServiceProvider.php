<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\ReportSubmitted;
use App\Listeners\SendReportToOrganization;
use App\Events\ReactionSubmitted;
use App\Listeners\SendReactionToPost;
use App\Models\Reaction;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ReportSubmitted::class => [
            SendReportToOrganization::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
