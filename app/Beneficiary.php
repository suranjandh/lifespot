<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class Beneficiary extends Member
{

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            $model->member_is_beneficiary = 1;
        });
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where('member_is_beneficiary',1);
    }

}
