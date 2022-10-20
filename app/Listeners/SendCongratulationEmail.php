<?php

namespace App\Listeners;

use App\Events\FirstBikeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCongratulationEmail
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
     * @param  \App\Events\FirstBikeCreated  $event
     * @return void
     */
    public function handle(FirstBikeCreated $event)
    {
        //
    }
}
