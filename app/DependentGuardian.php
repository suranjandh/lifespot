<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member ;

class DependentGuardian extends Member
{
    public function member()
    {
        return $this->belongsTo('App\Member','member_guardian_member_id','member_id');
    }


}
