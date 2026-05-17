<?php

namespace Database\Factories;

use App\DependentMedical;
use App\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\DependentMedical>
 */
class DependentMedicalFactory extends Factory
{
    use UkUsFaker;

    /**
     * @var class-string<\App\DependentMedical>
     */
    protected $model = DependentMedical::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $address = $this->ukUsAddress();

        return [
            'dependent_medical_member_id' => Member::factory()->dependent(),
            'dependent_medical_primary_care' => fake()->randomElement(['St Thomas Hospital', 'Manchester Royal Infirmary', 'Massachusetts General Hospital', 'NewYork-Presbyterian Hospital', 'UCLA Medical Center']),
            'dependent_medical_name' => 'Dr. ' . fake()->randomElement(['Smith', 'Johnson', 'Taylor', 'Wilson', 'Walker']),
            'dependent_medical_email' => fake()->unique()->safeEmail(),
            'dependent_medical_phone' => $this->ukUsPhone(),
            'dependent_medical_web' => fake()->optional(0.35)->url(),
            'dependent_medical_address' => $address['address'],
            'dependent_medical_address2' => $address['address2'],
            'dependent_medical_city' => $address['city'],
            'dependent_medical_state' => $address['state'],
            'dependent_medical_zip' => $address['zip'],
            'dependent_medical_special_notes' => fake()->optional(0.45)->sentence(),
            'dependent_medical_image' => '',
            'action_on' => 'Dependent',
        ];
    }
}
