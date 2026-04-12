<?php

namespace App\Http\Controllers\Auth;

use App\Estate;
use App\Events\UserRegistered;
use App\Profile;
use App\Relationship;
use App\Spouse;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/estate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Estate::create([
            'estate_user_id' => $user->id,
            'estate_name' => 'The ' . $data['first_name'] . ' ' . $data['last_name'] . ' Family Estate',
            'estate_owner_name' => $data['first_name']
        ]);

        Profile::create([
            'profile_user_id' => $user->id,
            'profile_first_name' => $data['first_name'],
            'profile_last_name' => $data['last_name'],
            'profile_email' => $data['email']
        ]);

        /*Spouse::create([
            'member_owner_user_id' => $user->id,
            'member_first_name' => '',
            'member_last_name' => '',
            'member_email' => '',
            'member_phone' => '',
            'member_gender' => '',
            'member_birth_day' => null,
            'member_role_in_estate' => '',
            'member_relationship_to_owner' => Relationship::get_relationship_name_by_relationship_id(18),
            'member_anniversary' => null,
            'member_special_notes' => '',
            'member_is_spouse' => 1
        ]);*/

        event(new UserRegistered($user));
        return $user;
    }
}
