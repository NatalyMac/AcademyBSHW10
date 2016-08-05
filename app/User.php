<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


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

}

