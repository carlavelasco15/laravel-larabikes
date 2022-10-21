<?php

namespace App\Listeners;

use App\Events\FirstBikeCreated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Congratulation;

class SendContragulationEmail
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
     * @param  object  $event
     * @return void
     */
    public function handle(FirstBikeCreated $event)
    {
       Mail::to($event->user->email)->send(new Congratulation($event->bike));
    }
}
