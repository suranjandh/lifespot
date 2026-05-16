<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DependentSchool extends Model
{
    protected $table = 'dependent_schools';

    protected $primaryKey = 'dependent_school_member_id';

    protected $guarded = [];
    public $timestamps = false;

    public $incrementing = false;

    use HasFactory, LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['dependent_school_name']);
    }



    public function member()
    {
        return $this->belongsTo('App\Member','member_id','dependent_school_member_id');
    }
}
