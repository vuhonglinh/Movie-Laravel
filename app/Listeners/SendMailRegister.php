<?php

namespace App\Listeners;

use App\Events\RegisterCustomers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailRegister
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
    public function handle(RegisterCustomers $event): void
    {
        //logic gửi Email
    }
}
