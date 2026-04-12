<?php

namespace App\Http\Controllers;

use App\Dependent;
use App\Helpers\Helper;
use App\Member;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class EstateImageController extends Controller
{
    use UploadTrait;

    public function ajax_estate_image(Request $request)
    {
        $estate_found = auth()->user()->estate;
        $image = $request->file('estate_image');
        if (!getimagesize($image)) {
            return Helper::error_message("Image Upload Error. Unknown Extension !");
        } else {
            $folder = '/' . Config::get('constants.ESTATE_IMG_FOLDER') . '/';
            $name = $estate_found->estate_id;
            $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
            $filePathUrl = Config::get('constants.ESTATE_IMG_URL') . $nameWithExtension;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $estate_found->estate_image = $nameWithExtension;
            $estate_found->save();
            return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
        }
    }


    public function ajax_profile_image(Request $request)
    {
        $profile_found = auth()->user()->profile;
        $image = $request->file('profile_image');
        if (!getimagesize($image)) {
            return Helper::error_message("Image Upload Error. Unknown Extension !");
        } else {
            $folder = '/' . Config::get('constants.PROFILE_IMG_FOLDER') . '/';
            $name = $profile_found->profile_id;
            $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
            $filePathUrl = Config::get('constants.PROFILE_IMG_URL') . $nameWithExtension;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $profile_found->profile_image = $nameWithExtension;
            $profile_found->save();
            return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
        }
    }


    public function ajax_member_image(Request $request)
    {
        $member_found = Member::find(Input::get('member_id'));
        $image = $request->file('member_image');
        if (!getimagesize($image)) {
            return Helper::error_message("Image Upload Error. Unknown Extension !");
        } elseif ($member_found) {
            $folder = '/' . Config::get('constants.MEMBER_IMG_FOLDER') . '/';
            $name = $member_found->member_id;
            $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
            $filePathUrl = Config::get('constants.MEMBER_IMG_URL') . $nameWithExtension;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user spouse image path in database to filePath
            $member_found->member_image = $nameWithExtension;
            $member_found->action_on = Input::get('action_on');
            $member_found->save();
            return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
        }
    }

    public function ajax_pet_image(Request $request)
    {
        $pet_found = Pet::find(Input::get('pet_id'));
        $image = $request->file('pet_image');
        if (!getimagesize($image)) {
            return Helper::error_message("Image Upload Error. Unknown Extension !");
        } elseif ($pet_found) {
            $folder = '/' . Config::get('constants.PET_IMG_FOLDER') . '/';
            $name = $pet_found->pet_id;
            $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
            $filePathUrl = Config::get('constants.PET_IMG_URL') . $nameWithExtension;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user spouse image path in database to filePath
            $pet_found->pet_image = $nameWithExtension;
            $pet_found->action_on = Input::get('action_on');
            $pet_found->save();
            return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
        }
    }

    public function ajax_dependent_school_image(Request $request)
    {
        $dependent_found = Dependent::find(Input::get('dependent_member_id'));
        if ($dependent_found) {
            $dependent_school = $dependent_found->dependent_school;
            if ($dependent_school) {
                $image = $request->file('dependent_school_image');
                if (!getimagesize($image)) {
                    return Helper::error_message("Image Upload Error. Unknown Extension !");
                } elseif ($dependent_school) {
                    $folder = '/' . Config::get('constants.DEPENDENT_SCHOOL_IMG_FOLDER') . '/';
                    $name = $dependent_school->dependent_school_member_id;
                    $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
                    $filePathUrl = Config::get('constants.DEPENDENT_SCHOOL_IMG_URL') . $nameWithExtension;
                    // Upload image
                    $this->uploadOne($image, $folder, 'public', $name);
                    // Set user spouse image path in database to filePath
                    $dependent_school->dependent_school_image = $nameWithExtension;
                    $dependent_school->action_on = Input::get('action_on');

                    $dependent_school->save();
                    return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
                }
            } else {
                return Helper::error_message("Please save dependent school first");
            }
        } else {
            return Helper::error_message("Please save dependent first");
        }
    }

    public function ajax_dependent_medical_image(Request $request)
    {
        $dependent_found = Dependent::find(Input::get('dependent_member_id'));
        if ($dependent_found) {
            $dependent_medical = $dependent_found->dependent_medical;
            if ($dependent_medical) {
                $image = $request->file('dependent_medical_image');
                if (!getimagesize($image)) {
                    return Helper::error_message("Image Upload Error. Unknown Extension !");
                } elseif ($dependent_medical) {
                    $folder = '/' . Config::get('constants.DEPENDENT_MEDICAL_IMG_FOLDER') . '/';
                    $name = $dependent_medical->dependent_medical_member_id;
                    $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
                    $filePathUrl = Config::get('constants.DEPENDENT_MEDICAL_IMG_URL') . $nameWithExtension;
                    // Upload image
                    $this->uploadOne($image, $folder, 'public', $name);
                    // Set user spouse image path in database to filePath
                    $dependent_medical->dependent_medical_image = $nameWithExtension;
                    $dependent_medical->action_on = Input::get('action_on');

                    $dependent_medical->save();
                    return Helper::success_message("Image Updated", $filePathUrl . '?rand=' . rand(1, 5000));
                }
            } else {
                return Helper::error_message("Please save dependent medical first");
            }
        } else {
            return Helper::error_message("Please save dependent first");
        }
    }

}
