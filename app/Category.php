<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $guarded = ['category_id'];

    public function category_subs(){
        return $this->hasMany('App\CategorySub','category_key','category_id');
    }


}
