<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Dependent;
use App\DependentMedical;
use App\DependentSchool;
use App\DocumentShare;
use App\Email;
use App\EmailQueue;
use App\EmptyLog;
use App\Estate;
use App\Events\MemberCreated;
use App\Events\MemberEdited;
use App\Helpers\Helper;
use App\Helpers\ValidatorSettings;
use App\Member;
use App\MemberShare;
use App\Pet;
use App\Profile;
use App\Spouse;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EstateController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function profile()
    {
        //$user = User::find(auth()->user()->id);
        // $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        // $profile_found = auth()->user()->profile;//Profile::where('profile_user_id', auth()->user()->id)->first();
        //Spouse::where('member_owner_user_id', auth()->user()->id)->first();
        $estate_found = auth()->user()->estate;//auth()->user()->estate();
        $data = compact('estate_found');
        return view('project.estates.index', $data);
    }

    public function estate()
    {

       // var_dump(Auth::user()->id); // returns 1
       // Auth::logout();

       // var_dump(Auth::user()); // returns null

      //  $user = User::find(2);
       // Auth::login($user);
       // var_dump(Auth::user()->id); // returns 2
       // Auth::logout();

        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }

    public function members()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }

    public function documents()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }

    public function webspot()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }



    public function grow_estate()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }

    public function ajax_estate_edit()
    {
        $estate = Input::all();//except(['action_on']);
        $validator = Validator::make(Input::all(), ValidatorSettings::get('estate'));
        if ($validator->fails()) {
            return Helper::error_message("Estate name , Owner name mandatory. Please Retry !");
        } else {
            auth()->user()->estate->update($estate);
            return Helper::success_message("Estate Updated", auth()->user()->estate);
        }
    }

    public function ajax_profile_edit()
    {
        $profile = Input::except(['profile_birth_day_age']);//except(['action_on','profile_birth_day_age']);
        $profile_birth_day_age = Input::get('profile_birth_day_age');
        if($profile_birth_day_age){
            $profile_birth_day =   Helper::age_month_day_to_date($profile_birth_day_age);
            $profile_age = Helper::age_month_day_to_json($profile_birth_day_age);
            $profile['profile_birth_day'] = $profile_birth_day ;
            $profile['profile_age'] = $profile_age ;
        }
        $validator = Validator::make(Input::all(), ValidatorSettings::get('profile'));
        if ($validator->fails()) {
            return Helper::error_message("First name , Last name mandatory. Please Retry !");
        } else {
            auth()->user()->profile->update($profile);
            $user = [
                'first_name' => Input::get('profile_first_name'),
                'last_name' => Input::get('profile_last_name')
            ];
            auth()->user()->update($user);
            return Helper::success_message("Profile Updated", auth()->user()->profile);
        }
    }


    public function ajax_member_edit()
    {
        $member_id = Input::get('member_id');
        $action_on = Input::get('action_on');
        $member_inputs = Input::except(['dependent_id', 'member_guardian_dependents','member_birth_day_age']);//except(['action_on', 'dependent_id', 'member_guardian_dependents','member_birth_day_age']);
        $member_birth_day_age = Input::get('member_birth_day_age');
        if($member_birth_day_age){
            $member_birth_day =   Helper::age_month_day_to_date($member_birth_day_age);
            $member_age = Helper::age_month_day_to_json($member_birth_day_age);
            $member_inputs['member_birth_day'] = $member_birth_day ;
            $member_inputs['member_age'] = $member_age ;
        }
        $member_roles = Input::get('member_role_in_estate') != '' ? explode('|', Input::get('member_role_in_estate')) : array();
        $validator = Validator::make(Input::all(), ValidatorSettings::get('spouse'));
        if ($validator->fails()) {
            return Helper::error_message("First name , Last name mandatory. Please Retry !");
        } else {
            $member = null;
            $action = "";
            if ($member_id > 0) {
                $member = Member::find($member_id);
                $member = $member->set_member_types($member, $member_roles, $action_on);
                $member->update($member_inputs);
                if ($action_on != 'Beneficiary' && $action_on != 'EmergencyContact' && $action_on != 'Friend') {
                    $member->roles()->sync($member_roles);
                }
                $action = "Updated";
                event(new MemberEdited($member));
            } else {
                $member = Member::create($member_inputs);
                $member = $member->set_member_types($member, $member_roles, $action_on);
                if ($action_on != 'Beneficiary' && $action_on != 'EmergencyContact' && $action_on != 'Friend') {
                    $member->roles()->sync($member_roles);
                }
                event(new MemberCreated($member));
                $action = "Created";
            }
            if ($action_on == 'GuardianMember') {
                $dependent_id = Input::get('dependent_id');
                $dependent = Dependent::find($dependent_id);
                $dependent->member_guardian_member_id = $member->member_id;
                $dependent->save();
            }
            if ($action_on == 'Member') {
                $member_guardian_dependents = Input::get('member_guardian_dependents');
                Member::where('member_guardian_member_id', $member->member_id)->update(['member_guardian_member_id' => 0]);
                $member_guardian_dependents_array = explode(',', $member_guardian_dependents);
                foreach ($member_guardian_dependents_array as $member_guardian_dependent) {
                    $dependent = Dependent::find($member_guardian_dependent);
                    if ($dependent) {
                        $dependent->member_guardian_member_id = $member->member_id;
                        $dependent->save();
                    }
                }
            }
            return Helper::success_message("$action_on $action", $member);
        }
    }

    public function ajax_edit_dependent_medical()
    {
        $dependent_medical_member_id = Input::get('dependent_medical_member_id');
        $dependent_medical = DependentMedical::find($dependent_medical_member_id);
        if ($dependent_medical) {
            $dependent_medical->update(Input::all());
            return Helper::success_message("Dependent Medical Updated", DependentMedical::find($dependent_medical_member_id));
        } else {
            $dependent_medical = DependentMedical::create(Input::all());
            return Helper::success_message("Dependent Medical Created", $dependent_medical);
        }
    }

    public function ajax_edit_dependent_school()
    {
        $dependent_school_member_id = Input::get('dependent_school_member_id');
        $dependent_school = DependentSchool::find($dependent_school_member_id);
        if ($dependent_school) {
            $dependent_school->update(Input::all());
            return Helper::success_message("Dependent School Updated", DependentSchool::find($dependent_school_member_id));
        } else {
            $dependent_school = DependentSchool::create(Input::all());
            return Helper::success_message("Dependent School Created", $dependent_school);
        }
    }


    public function ajax_pet_edit()
    {
        $pet_id = Input::get('pet_id');
        $action_on = Input::get('action_on');
        $pet_inputs = Input::except(['pet_guardian', 'pet_guardian_first_name', 'pet_guardian_last_name']);
        $validator = Validator::make(Input::all(), ValidatorSettings::get('pet'));
        if ($validator->fails()) {
            return Helper::error_message("Pet name mandatory. Please Retry !");
        } else {
            $pet = null;
            if ($pet_id > 0) {
                $pet = Pet::find($pet_id);
                $pet->update($pet_inputs);
                $pet->process_pet_guardian($pet_id, Input::get('pet_guardian'),
                    Input::get('pet_guardian_first_name'), Input::get('pet_guardian_last_name'));

                return Helper::success_message("$action_on Updated", $pet);
            } else {
                $pet = Pet::create($pet_inputs);
                $pet->process_pet_guardian($pet->pet_id, Input::get('pet_guardian'),
                    Input::get('pet_guardian_first_name'), Input::get('pet_guardian_last_name'));
                return Helper::success_message("$action_on Created", $pet);
            }
        }
    }


    public function ajax_member_popup()
    {
        return View(Input::get('view'), Input::all());
    }

    public function ajax_pet_guardian_suggest()
    {
        //$current_member_id = isset($_POST['current_member_id']) ? $database->escape_string($_POST['current_member_id']) : 0;
        $search_result = Member::search_member(Input::get('member_first_name'),
            $search_result = Input::get('member_last_name'), Input::get('current_member_id'));
        return view('project.estates.forms.memberForms.member_search_pet', compact('search_result'));
        //include 'member_search_pet.php';
    }


    public function ajax_member_guardian_suggest()
    {
        //$current_member_id = isset($_POST['current_member_id']) ? $database->escape_string($_POST['current_member_id']) : 0;
        $search_result = Member::search_member(Input::get('member_first_name'),
            Input::get('member_last_name'), Input::get('current_member_id'));
        return view('project.estates.forms.memberForms.member_search', compact('search_result'));
        //include 'member_search_pet.php';
    }

    public function ajax_get_member()
    {
        return Helper::success_message('', Member::find(Input::get('member_id')));
    }

    public function ajax_dependent_popup()
    {
        $dependent_member_id = Input::get('dependent_member_id');
        return view('project.estates.forms.MyFamily.dependents.popup_modal.dependent_main', compact('dependent_member_id'));
    }

    public function ajax_return_view()
    {
        $view = Input::get('view');
        return view($view, Input::all());
    }

    public function ajax_share_unshare_member()
    {
        $member_share_inputs = Input::except(['shared']);
        $shared = Input::get('shared');
        if ($shared == 1) {
            MemberShare::create($member_share_inputs);
            return Helper::success_message('Shared to member');
        } else {
            MemberShare::where($member_share_inputs)->delete();
            return Helper::error_message('UnShared to member');
        }
    }

    public function ajax_member_share()
    {
        $document_share_document_id = Input::get('document_share_document_id');
        $document_share_member_id = Input::get('document_share_member_id');
        $document_share_member_type = Input::get('document_share_member_type');
        $shared = Input::get('shared');
        $document_share = array(
            'document_share_document_id' => $document_share_document_id,
            'document_share_member_id' => $document_share_member_id,
            'document_share_member_type' => $document_share_member_type
        );
        if ($document_share_document_id > 0 && $document_share_member_id > 0 && $document_share_member_type != '')
            if ($shared == 1) {
                DocumentShare::where($document_share)->delete();
                DocumentShare::create($document_share);
                return Helper::success_message("Document Shared");
            } else {
                DocumentShare::where($document_share)->delete($document_share);
                return Helper::success_message("Un sharing Document");
            }
        return Helper::error_message("Error . Please retry !");
    }

    public function member_delete(){
        $member_id = Input::get('member_member_id');
        $member = Member::where(['member_id'=>$member_id,'member_owner_user_id'=>\auth()->user()->id])->first();
        if($member){
            $member->action_on = 'Member';
            $member->delete();
            return Helper::success_message("Member Deleted");
        }else{
            return Helper::error_message("Error . Please retry !");
        }
    }

    public function pet_delete(){
        $pet_id = Input::get('pet_id');
        $pet = Member::where(['pet_id'=>$pet_id,'pet_owner_user_id'=>\auth()->user()->id])->first();
        if($pet){
            $pet->action_on = 'Pet';
            $pet->delete();
            return Helper::success_message("Pet Deleted");
        }else{
            return Helper::error_message("Error . Please retry !");
        }
    }




}
