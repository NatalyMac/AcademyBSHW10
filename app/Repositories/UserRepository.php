<?php

namespace App\Repositories;

use App\User;
use App\Book;

class UserRepository extends AbstractRepository
{

    function model()
    {
        return 'App\User';
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserChargedBook($user_id)
    {
        $user = User::findorFail($user_id);
            return $user->books()->wherePivot('date_getin_fact', null)->get();
    }

    /**
     * @param $user_id
     * @param $book_id
     * @return null
     */
    public function setUserBook($user_id, $book_id)
    {
        $user = User::findorFail($user_id);
        $book = Book::findorFail($book_id);

        if (!$book->is_charged)
        {
            $user->books()->attach($book_id, 
                  ['date_getin_plan' => date('Y:m:d H:m:s', (time() + 60000))]);
            
            $book->setBookCharged();
            
            return $user->books()->wherePivot('book_id', $book_id)
                        ->wherePivot('date_getin_fact', null)->get();
            
        } else return null;
    }

    /**
     * @param $user_id
     * @param $book_id
     * @return int
     */
    public function unsetUserBook($user_id, $book_id)
    {
        $user = User::findorFail($user_id);
        $book = Book::findorFail($book_id);
        $result = 0;

        if ($book->isCharged())
           $result = $user->books()->wherePivot('date_getin_fact', null)
                          ->wherePivot('book_id', $book_id)
                          ->updateExistingPivot($book_id,
                                       ['date_getin_fact'=> date('Y:m:d H:m:s', (time()))]);

        if ($result) 
            $book->setBookDisCharged();
        
        return $result;
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserBookHistory($user_id)
    {
        $user = User::findorFail($user_id);
        return $user->books;
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function isBookHolder($user_id)
    {
        $user = User::findorFail($user_id);
        return (!$user->books()->wherePivot('date_getin_fact', null)->get());
    }

    /**
     * @return array
     */
    public function getCreateRules()
    {
        return User::getCreateRules();
    }

    /**
     * @return array
     */
    public function getUpdateRules()
    {
        return User::getUpdateRules();
    }
}
