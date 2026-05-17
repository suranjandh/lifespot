<?php

namespace Database\Factories;

use App\Member;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Member>
 */
class MemberFactory extends Factory
{
    use UkUsFaker;

    /**
     * @var class-string<\App\Member>
     */
    protected $model = Member::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = $this->ukUsPerson();
        $address = $this->ukUsAddress();

        return [
            'member_owner_user_id' => User::factory(),
            'member_first_name' => $person['first'],
            'member_last_name' => $person['last'],
            'member_email' => fake()->unique()->safeEmail(),
            'member_phone' => $this->ukUsPhone(),
            'member_address' => $address['address'],
            'member_address2' => $address['address2'],
            'member_city' => $address['city'],
            'member_state' => $address['state'],
            'member_zip' => $address['zip'],
            'member_gender' => $person['gender'],
            'member_maritalStatus' => fake()->randomElement(['Single', 'Married', 'Widowed', 'Divorced']),
            'member_nickName' => fake()->optional(0.4)->firstName(),
            'member_dependents' => fake()->numberBetween(0, 3),
            'member_image' => '',
            'member_role_in_estate' => fake()->randomElement(['Executor', 'Trustee', 'Beneficiary', 'Guardian', 'Advisor']),
            'member_relationship_to_owner' => fake()->randomElement(['Spouse', 'Parent', 'Child', 'Sibling', 'Friend', 'Attorney']),
            'member_anniversary' => fake()->boolean(35) ? fake()->dateTimeBetween('-35 years', '-1 year')->format('Y-m-d') : null,
            'member_special_notes' => fake()->optional(0.35)->sentence(),
            'member_is_dependent' => 0,
            'member_is_spouse' => 0,
            'member_is_beneficiary' => fake()->boolean(35) ? 1 : 0,
            'member_is_emergency_contact' => fake()->boolean(25) ? 1 : 0,
            'member_is_friend' => fake()->boolean(20) ? 1 : 0,
            'isAssociatedWithCoTrustee' => fake()->boolean(10) ? 1 : 0,
            'member_phone2' => fake()->boolean(25) ? $this->ukUsPhone() : null,
            'member_birth_day' => fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'isAssociatedWithSpouse' => fake()->boolean(10) ? 1 : 0,
            'member_associated_user' => 0,
            'member_invitation_status' => fake()->numberBetween(0, 2),
            'member_join_account_access' => fake()->boolean(10) ? 1 : 0,
            'member_gifts' => fake()->optional(0.2)->randomElement(['Tea set', 'Books', 'Gourmet hamper', 'Flowers']),
            'member_age' => null,
            'member_guardian_member_id' => null,
            'action_on' => 'Member',
        ];
    }

    public function dependent(): static
    {
        return $this->state(function (array $attributes): array {
            return [
                'member_is_dependent' => 1,
                'member_birth_day' => fake()->dateTimeBetween('-17 years', '-2 years')->format('Y-m-d'),
                'member_maritalStatus' => 'Single',
                'member_relationship_to_owner' => fake()->randomElement(['Child', 'Niece', 'Nephew', 'Ward']),
                'member_role_in_estate' => 'Dependent',
            ];
        });
    }
}
