<?php

namespace App\Console;

use App\Repositories\UserRepository;
use App\Http\Controllers\SendRemindMail;
use App\UserBook;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){

            $users = UserRepository::usersToRemind();
            
            $smr = new SendRemindMail();

            $smr->sendReminderBook($users, 'return', null);

            if (count($users)){
            UserBook::setRemind();

            }
        //dev mode
        })->everyMinute();
        //prod mode daily();
    }
}
