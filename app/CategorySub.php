<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model
{
    protected $table = 'categories_sub';

    protected $primaryKey = 'category_sub_id';

    protected $guarded = ['category_sub_id'];

    public function category(){
        return $this->belongsTo('App\Category','category_id','category_key');
    }

    public function document_content_types(){
        return $this->hasMany('App\DocumentContentType','document_content_type_sub_category','category_sub_id');
    }

    public static function category_tree(){
        $sub_categories = CategorySub::join('categories', 'categories.category_id', '=', 'categories_sub.category_key')->get();
        $category_tree = array();
        foreach ($sub_categories as $v) {
            $category_tree[$v->category_id][$v->category_sub_id] = $v;
        }
        return $category_tree;
    }

    public static function get_sub_sub_categories_by_sub_category_for_user($sub_category_id)
    {

        //$sub_category = $this->get_sub_categories_by_id($sub_category_id);
        $sub_category = CategorySub::find($sub_category_id);
        $sub_sub_category = array();
        if ($sub_category) {
            switch ($sub_category->category_sub_name) {
                case 'Dependents':
                    $result = Dependent::where('member_owner_user_id',auth()->user()->id)->get();
                    if ($result) {
                        foreach ($result as $v) {
                            $sub_sub_category[] = array(
                                'category_sub_sub_id' => $v->member_id,
                                'category_sub_sub_name' => $v->member_first_name . ' ' . $v->member_last_name);
                        }
                    }
                    break;
                case 'Beneficiaries':
                    $result = Beneficiary::where('member_owner_user_id',auth()->user()->id)->get();
                    if ($result) {
                        foreach ($result as $v) {
                            $sub_sub_category[] = array(
                                'category_sub_sub_id' => $v->member_id,
                                'category_sub_sub_name' => $v->member_first_name . ' ' . $v->member_last_name);
                        }
                    }
                    break;
                case 'Emergency Contacts':
                    $result = EmergencyContact::where('member_owner_user_id',auth()->user()->id)->get();
                    if ($result) {
                        foreach ($result as $v) {
                            $sub_sub_category[] = array(
                                'category_sub_sub_id' => $v->member_id,
                                'category_sub_sub_name' => $v->member_first_name . ' ' . $v->member_last_name);
                        }
                    }
                    break;
                case 'Members':
                    $result = Member::where('member_owner_user_id',auth()->user()->id)->get();
                    if ($result) {
                        foreach ($result as $v) {
                            $sub_sub_category[] = array(
                                'category_sub_sub_id' => $v->member_id,
                                'category_sub_sub_name' => $v->member_first_name . ' ' . $v->member_last_name);
                        }
                    }
                    break;
                case 'Pets':
                    $result = Pet::where('pet_owner_user_id',auth()->user()->id)->get();
                    if ($result) {
                        foreach ($result as $v) {
                            $sub_sub_category[] = array(
                                'category_sub_sub_id' => $v->member_id,
                                'category_sub_sub_name' => $v->pet_name);
                        }
                    }
                    break;
            }
        }
        return $sub_sub_category;
    }


    public function get_sub_sub_sub_categories_by_sub_category_for_user($sub_category_id)
    {

        $sub_category = CategorySub::find($sub_category_id);//$this->get_sub_categories_by_id($sub_category_id);
        $sub_sub_category = array();
        if ($sub_category) {
            switch ($sub_category['category_sub_name']) {
                case 'Dependents':
                    $sub_sub_sub_category_ar = array(
                        1 => 'Dependent Profile',
                        2 => 'Dependent Medical', 3 => 'Dependent Guardian', 4 => 'Dependent School'
                    );
                    foreach ($sub_sub_sub_category_ar as $k => $v) {
                        $sub_sub_sub_category[] = array(
                            'category_sub_id' => $k,
                            'category_sub_name' => $v);
                    }
                    break;
            }
        }
        return $sub_sub_sub_category;
    }


    public static function get_sub_sub_categories_by_id($category_sub_sub_id, $sub_category_id)
    {

        $sub_category = CategorySub::find($sub_category_id);// $this->get_sub_categories_by_id($sub_category_id);
        $sub_sub_category = array();
        if ($sub_category) {
            switch ($sub_category->category_sub_name) {
                case 'Dependents':
                    $member_id = $category_sub_sub_id;
                    $result = Member::find($member_id);
                    if ($result) {
                        $sub_sub_category = array(
                            'category_sub_id' => $result->member_id,
                            'category_sub_name' => $result->member_first_name . ' ' . $result->member_last_name);

                    }
                    break;
                case 'Beneficiaries':
                    $member_id = $category_sub_sub_id;
                    $result = Member::find($member_id);
                    if ($result) {
                        $sub_sub_category = array(
                            'category_sub_id' => $result->member_id,
                            'category_sub_name' => $result->member_first_name . ' ' . $result->member_last_name);

                    }
                    break;

                case 'Emergency Contacts':
                    $member_id = $category_sub_sub_id;
                    $result = Member::find($member_id);
                    if ($result) {
                        $sub_sub_category = array(
                            'category_sub_id' => $result->member_id,
                            'category_sub_name' => $result->member_first_name . ' ' . $result->member_last_name);

                    }
                    break;

                case 'Pets':
                    $pet_id = $category_sub_sub_id;
                    $result = Pet::find($pet_id);
                    if ($result) {
                        $sub_sub_category = array(
                            'category_sub_id' => $result->pet_id,
                            'category_sub_name' => $result->pet_name);

                    }
                    break;
            }
        }
        return $sub_sub_category;
    }

}
