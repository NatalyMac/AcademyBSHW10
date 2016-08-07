<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $createRules = ['firstname' => 'required|alpha',
        'lastname' => 'required|alpha',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required'];

    protected $updateRules = ['firstname' => 'required|alpha',
        'lastname' => 'required|alpha',
        'email' => 'required|email'];

    protected $remindAfter = 30;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany('App\Book', 'user_books')
            ->withPivot('date_getin_plan', 'date_getin_fact')
            ->withTimestamps();
    }


    /**
     * @return array
     */
    public static function getCreateRules()
    {
        $_this = new self;
        return $_this->createRules;
    }

    /**
     * @return array
     */
    public static function getUpdateRules()
    {
        $_this = new self;
        return $_this->updateRules;
    }

    public static function getUsersToRemind()
    {
        $users = DB::table('users')
            ->join('user_books', function ($join) {
                $join->on('users.id', '=', 'user_books.user_id')
                    ->whereNull('user_books.date_getin_fact')
                    ->where('user_books.created_at', '<',
                        date('Y:m:d H:m:s', (time() - (60*60*24*30))))
                    ->where('user_books.is_remind', '=', false);
            })
            ->join('books', 'user_books.book_id', '=', 'books.id')
            ->get();
             return $users;
    }


//SELECT users. * , books.title, books.author
//FROM users
//JOIN (

//SELECT user_books.user_id, user_books.book_id
//FROM user_books
//WHERE user_books.date_getin_fact IS NULL
//) AS l ON users.id = l.user_id
//JOIN books ON books.id = l.book_id





}

