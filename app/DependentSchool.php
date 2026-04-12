<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DependentSchool extends Model
{
    protected $table = 'dependent_schools';

    protected $primaryKey = 'dependent_school_member_id';

    protected $guarded = [];
    public $timestamps = false;

    public static $logAttributes = ['dependent_school_name'];

    use LogsActivity;


    public function member()
    {
        return $this->belongsTo('App\Member','member_id','dependent_school_member_id');
    }
}
