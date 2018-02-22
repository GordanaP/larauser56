<?php

namespace App\Listeners\Auth;

use App\Events\Auth\EmailVerified;
use App\Mail\Auth\PleaseConfirmYourEmailAddress;
use App\Mail\Auth\ThankYouForRegisteringWithUs;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class ActivateAccount
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
     * Handle the account created event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function sendActivationToken(Registered $event)
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmailAddress  ($event->user->activationToken));
    }

    /**
     * Handle the email verified event.
     *
     * @param  EmailVerified  $event
     * @return void
     */
    public function sendThankYouNote(EmailVerified $event)
    {
        Mail::to($event->user)->send(new ThankYouForRegisteringWithUs($event->user));
    }
}
