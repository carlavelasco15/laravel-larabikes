<?php

namespace App\Listeners;

use App\Events\FirstBikeCreated;
use App\Mail\Congratulation;
use Illuminate\Support\Facades\Mail;

class SendContragulationEmail
{
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
