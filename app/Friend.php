<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Member
{
    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            $model->member_is_friend = 1;
        });
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where('member_is_friend',1);
    }
}
