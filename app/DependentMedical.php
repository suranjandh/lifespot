<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DependentMedical extends Model
{
    protected $table = 'dependent_medicals';

    protected $primaryKey = 'dependent_medical_member_id';

    protected $guarded = [];

    public $timestamps = false;

    use LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['dependent_medical_name']);
    }



    public function member()
    {
        return $this->belongsTo('App\Member','member_id','dependent_medical_member_id');
    }
}
