<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Jobs\SendReminderEmail;

class SendRemindMail extends Controller
{
    /**
     * UserController constructor.
     * @param UserRepository $users
     */

    public function sendReminderBook($users, $typeRemind, $book)
    {
        $book_attr=[];
        $subjectText ='';
        if ($typeRemind =='new')
        {
            $subjectText = "We have new book";
            if ($book) {
                $book_attr['title'] = $book->title;
                $book_attr['author'] = $book->author;
            };
        }
        if ($typeRemind == 'return') {
            $subjectText = "You should return the book";
        };
        foreach ($users as $user) {
            if ($typeRemind == 'new') {
                $this->dispatch(new SendReminderEmail($user, $subjectText, $book_attr, $typeRemind));
            };
            if ($typeRemind == 'return') {
                $book_attr['title'] = $user->title;
                $book_attr['author'] = $user->author;
                $this->dispatch(new SendReminderEmail($user, $subjectText, $book_attr, $typeRemind));
            };
        }
    }
}