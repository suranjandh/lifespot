<?php

namespace Database\Factories;

use App\DependentSchool;
use App\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\DependentSchool>
 */
class DependentSchoolFactory extends Factory
{
    use UkUsFaker;

    /**
     * @var class-string<\App\DependentSchool>
     */
    protected $model = DependentSchool::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $address = $this->ukUsAddress();

        return [
            'dependent_school_member_id' => Member::factory()->dependent(),
            'dependent_school_name' => fake()->randomElement(['Westminster School', 'Manchester Grammar School', 'Boston Latin School', 'Lincoln High School', 'Roosevelt Elementary School', 'St. Mary\'s School']),
            'dependent_school_grade' => 'Grade ' . fake()->numberBetween(1, 13),
            'dependent_school_email' => fake()->unique()->safeEmail(),
            'dependent_school_phone' => $this->ukUsPhone(),
            'dependent_school_counselor' => fake()->randomElement(['Ms. Smith', 'Mr. Johnson', 'Ms. Taylor', 'Mr. Wilson', 'Ms. Walker']),
            'dependent_school_address' => $address['address'],
            'dependent_school_address2' => $address['address2'],
            'dependent_school_city' => $address['city'],
            'dependent_school_state' => $address['state'],
            'dependent_school_zip' => $address['zip'],
            'dependent_school_special_notes' => fake()->optional(0.45)->sentence(),
            'dependent_school_image' => '',
            'action_on' => 'Dependent',
        ];
    }
}
