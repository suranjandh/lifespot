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
    use SriLankanFaker;

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
            'pet_name' => fake()->randomElement(['Bola', 'Kalu', 'Sudu', 'Rosa', 'Malli', 'Chooti', 'Raja', 'Kiri', 'Lassie', 'Milo']),
            'pet_gender' => fake()->randomElement(['Male', 'Female']),
            'pet_image' => '',
            'pet_clinic_name' => fake()->randomElement(['Colombo Pet Vet', 'Kandy Animal Clinic', 'Galle Veterinary Care', 'Negombo Pet Hospital']),
            'pet_description' => fake()->randomElement(['Sri Lankan street dog', 'Labrador retriever', 'Persian cat', 'Domestic shorthair cat', 'Parrot']),
            'pet_tag_id' => 'LK-PET-' . fake()->unique()->numerify('#####'),
            'pet_veterinarian_phone' => $this->sriLankanPhone(),
            'pet_birth_day' => fake()->dateTimeBetween('-14 years', '-3 months')->format('Y-m-d'),
            'pet_doctor_name' => 'Dr. ' . fake()->randomElement(['Perera', 'Fernando', 'Silva', 'Jayasinghe', 'Herath']),
            'pet_guardian' => Member::factory(),
            'pet_notes' => fake()->optional(0.45)->sentence(),
            'action_on' => 'Pet',
        ];
    }
}
