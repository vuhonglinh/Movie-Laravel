<?php

namespace App\Listeners;

use App\Events\CheckoutSuccess;
use App\Mail\SendOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailOrder implements ShouldQueue
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
    public function handle(CheckoutSuccess $event): void
    {
        // Mail::to($event->customer)->send(new SendOrder($this->order));
    }
}
