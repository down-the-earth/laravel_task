<?php

namespace App\Listeners;

use App\Events\Postupdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class PostEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Postupdate $event): void
    {
        Mail::to('gaonkars193@gmail.com')->send(new SendEmail($event->post));
    }
}
