<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\BookRepository;


class UserBookController extends Controller
{
    /**
     * LendController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users, BookRepository $books)
    {
        $this->users = $users;
        $this->books = $books;
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function index($user_id)
    {
        $chargedBooks = $this->users->getUserChargedBook($user_id);

        return response()->json($chargedBooks);
    }

    /**
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function update($user_id, $book_id)
    {
        $charged_book = $this->users->setUserBook($user_id, $book_id);

        if ($charged_book)
            return response()->json($charged_book);
        else return  response()->json(['message'=>"This book ID".$book_id." has been charged "], 400);
    }

    /**
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function destroy($user_id, $book_id)
    {
        $result = $this->users->unsetUserBook($user_id, $book_id);
        if ($result) return response()->json(['message'=>'Book ID'.$book_id.' is discharged'], 200);
           else return response()->json(['message'=>'Book ID'. $book_id.
                                         ' is not charged by user ID'.$user_id], 400);
    }
}
