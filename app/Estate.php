<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Estate extends Model
{
    protected $table = 'estates';

    protected $primaryKey = 'estate_id';

    protected $guarded = ['estate_id'];

    public static $logAttributes = ['estate_name'];

    use LogsActivity;

    public static function boot()
    {
        parent::boot();
        \App\Estate::updated(function ($model) {
            $model->action_on = 'Estate';
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
        \App\Estate::created(function ($model) {
            $model->action_on = 'Estate';
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
    }


    public function user()
    {
        return $this->belongsTo('App\User','id','estate_user_id');
    }

    public function get_estate_location($estate){
        $address_content = array();
        $address_content_fields = array(
            'estate_address','estate_address2','estate_city','estate_state','estate_zip'
        );
        foreach($address_content_fields as $v){
            if(trim($estate->$v) != '')$address_content[] = $estate->$v;
        }
        return implode(" , ",$address_content);
    }

    public function get_estate_name($estate){
        return "{$estate->estate_name}";
    }
}
