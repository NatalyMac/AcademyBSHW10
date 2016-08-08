<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use App\Book;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $subject;
    protected $book;
    protected $typeRemind;

    public function __construct($user, $subject, $book, $typeRemind)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->book = $book; //array attrs
        $this->typeRemind = $typeRemind;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //emulation for queue of mailsending, overlimited google mailbox
        // var_dump($this->user->firstname);
        // var_dump($this->book);
        // var_dump($this->subject);
        // var_dump($this->typeRemind);

        $mailer->send('mails.reminder', ['user' => $this->user,
                                         'book'=>$this->book,
                                    
                                         'subject'=>$this->subject,
                                         'type'=>$this->typeRemind],
           function ($m)
           {
                $m->to($this->user->email, $this->user->firstname)
                ->subject($this->subject);
           });
        
    }
}
