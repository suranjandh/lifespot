<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DependentMedical extends Model
{
    protected $table = 'dependent_medicals';

    protected $primaryKey = 'dependent_medical_member_id';

    protected $guarded = [];

    public $timestamps = false;

    public static $logAttributes = ['dependent_medical_name'];

    use LogsActivity;


    public function member()
    {
        return $this->belongsTo('App\Member','member_id','dependent_medical_member_id');
    }
}
