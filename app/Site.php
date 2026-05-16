<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Site extends Model
{
    protected $table = 'sites';

    protected $primaryKey = 'site_id';

    protected $guarded = ['site_id'];

    public $timestamps = false ;

    use LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['site_name']);
    }


    public static function boot() {
        parent::boot();
        \App\Site::creating(function ($model) {
            if(\Auth::check()) {
                $model->site_owner_user_id = auth()->user()->id;
            }
        });
        \App\Site::updated(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
        \App\Site::created(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
    }


    public function user()
    {
        return $this->belongsTo('App\User','id','site_owner_user_id');
    }

}
