<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserBook extends Model
{
    protected $remindAfter = 30;

    public static function setRemind()
    {
        DB::table('user_books')
            ->whereNull('date_getin_fact')
            ->where('created_at', '<',
                date('Y:m:d H:m:s', (time() - (60*60*24*30))))
            ->where('is_remind', '=', false)
            ->update(['is_remind' => true]);
    }
}
