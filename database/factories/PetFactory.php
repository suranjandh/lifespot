<?php

namespace Database\Factories;

use App\Member;
use App\Pet;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Pet>
 */
class PetFactory extends Factory
{
    use UkUsFaker;

    /**
     * @var class-string<\App\Pet>
     */
    protected $model = Pet::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_owner_user_id' => User::factory(),
            'pet_name' => fake()->randomElement(['Max', 'Bella', 'Charlie', 'Luna', 'Daisy', 'Buddy', 'Molly', 'Oscar', 'Ruby', 'Milo']),
            'pet_gender' => fake()->randomElement(['Male', 'Female']),
            'pet_image' => '',
            'pet_clinic_name' => fake()->randomElement(['London Pet Vet', 'Manchester Animal Clinic', 'Brooklyn Veterinary Care', 'Seattle Pet Hospital']),
            'pet_description' => fake()->randomElement(['Labrador retriever', 'Cocker spaniel', 'British shorthair cat', 'Domestic shorthair cat', 'Golden retriever']),
            'pet_tag_id' => 'PET-' . fake()->unique()->numerify('#####'),
            'pet_veterinarian_phone' => $this->ukUsPhone(),
            'pet_birth_day' => fake()->dateTimeBetween('-14 years', '-3 months')->format('Y-m-d'),
            'pet_doctor_name' => 'Dr. ' . fake()->randomElement(['Smith', 'Johnson', 'Taylor', 'Wilson', 'Walker']),
            'pet_guardian' => Member::factory(),
            'pet_notes' => fake()->optional(0.45)->sentence(),
            'action_on' => 'Pet',
        ];
    }
}
