<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class Spouse extends Member
{

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            $model->member_is_spouse = 1;
        });
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where('member_is_spouse',1);
    }

    public function user()
    {
        return $this->belongsTo('App\User','id','member_owner_user_id');
    }


}
