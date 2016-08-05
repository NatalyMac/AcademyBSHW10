<?php
namespace App\Repositories;

use App\Book;

class BookRepository extends AbstractRepository
{
    /**
     * @return string
     */
    function model()
    {
        return 'App\Book';
    }

    /**
     * @param $id
     * @return mixed
     */
    public function isCharged($id)
    {
        $book = Book::findOrFail($id);
        return $book->isCharged();
    }


    /**
     * @return array
     */
    public function getRules()
    {
        return Book::getRules();
    }
}
