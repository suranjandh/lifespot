<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentContentType extends Model
{
    protected $table = 'document_content_types';

    protected $primaryKey = 'document_content_type_id';

    protected $guarded = ['document_content_type_id'];

    public function category_sub(){
        return $this->belongsTo('App\CategorySub','category_sub_id','document_content_type_sub_category');
    }
}
