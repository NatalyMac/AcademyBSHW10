<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;


//$mailer->send('emails.reminder', ['user' => $this->user], function ($m) {
//var_dump('job');
// $m->from('hello@app.com', 'Your Application');

//$m->to($this->user->email, $this->user->firstname)->subject('Your Reminder!');
//});

//$this->user->reminders()->create(...);
}
