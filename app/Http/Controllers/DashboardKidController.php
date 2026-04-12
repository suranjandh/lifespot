<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Helpers\Helper;
use App\Helpers\ValidatorSettings;
use App\Site;
use App\Spouse;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class DashboardKidController extends Controller
{

    use UploadTrait ;

    public function index(){

        return view('project.kid.index');
    }

    public function profile(){
        return view('project.kid.index');
    }

    public function shared_info(){
        return __FUNCTION__ ;
    }

    public function game_center(){
        return __FUNCTION__ ;
    }

    public function members()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.kid.index', $data);
    }

    public function ajax_site_edit(){
        $site_data = Input::all();///except('action_on');
        $validator = Validator::make(Input::all(), ValidatorSettings::get('site'));
        if ($validator->fails()) {
            return Helper::error_message("All fields mandatory. Please Retry !");
        } else {
            $site_found = auth()->user()->site ;
            $action = '';
            if($site_found){
                $site = Site::find($site_found->site_id);
                $site->update($site_data);
                $action = 'updated';
            }else{
                $site = Site::create($site_data);
                $action = 'created';
            }
            return Helper::success_message("Site {$action} !",auth()->user()->site);
        }
    }


    public function ajax_site_image(Request $request)
    {
        $site_found = auth()->user()->site;
        $image = $request->file('site_picture');
        if (!getimagesize($image)) {
            return Helper::error_message("Image Upload Error. Unknown Extension !");
        } elseif($site_found) {
            $folder = '/' . Config::get('constants.SITE_IMG_FOLDER') . '/';
            $name = $site_found->site_id;
            $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
            $filePathUrl = Config::get('constants.SITE_IMG_URL') . $nameWithExtension;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user spouse image path in database to filePath
            $site_found->site_image = $nameWithExtension;
            $site_found->save();
            return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
        }
    }
}
