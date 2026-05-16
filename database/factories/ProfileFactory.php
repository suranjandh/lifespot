<?php

namespace Database\Factories;

use App\Profile;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Profile>
 */
class ProfileFactory extends Factory
{
    use SriLankanFaker;

    /**
     * @var class-string<\App\Profile>
     */
    protected $model = Profile::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = $this->sriLankanPerson();
        $address = $this->sriLankanAddress();

        return [
            'profile_user_id' => User::factory(),
            'profile_first_name' => $person['first'],
            'profile_address2' => $address['address2'],
            'profile_last_name' => $person['last'],
            'profile_email' => fake()->unique()->safeEmail(),
            'profile_phone' => $this->sriLankanPhone(),
            'profile_phone2' => fake()->boolean(25) ? $this->sriLankanPhone() : null,
            'profile_address' => $address['address'],
            'profile_city' => $address['city'],
            'profile_state' => $address['state'],
            'profile_zip' => $address['zip'],
            'profile_gender' => $person['gender'],
            'profile_birth_day' => fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'profile_maritalStatus' => fake()->randomElement(['Single', 'Married', 'Widowed', 'Divorced']),
            'profile_nickName' => fake()->optional(0.35)->firstName(),
            'profile_dependents' => (string) fake()->numberBetween(0, 4),
            'profile_profile_notes' => fake()->optional(0.4)->sentence(),
            'profile_image' => '',
            'profile_age' => null,
            'action_on' => 'Profile',
        ];
    }
}
