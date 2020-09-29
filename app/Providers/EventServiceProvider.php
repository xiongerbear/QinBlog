<?php

namespace App\Providers;

use App\Listeners\MessageLoggedListener;
use App\Listeners\QueryExecutedListener;
use App\Listeners\RegisteredSuccess;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Log\Events\MessageLogged;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageLogged::class => [
            MessageLoggedListener::class,
        ],

        QueryExecuted::class => [
            QueryExecutedListener::class,
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
            RegisteredSuccess::class,
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\GitHub\GitHubExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
