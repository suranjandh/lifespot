<?php

namespace Database\Factories;

use App\Estate;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Estate>
 */
class EstateFactory extends Factory
{
    use UkUsFaker;

    /**
     * @var class-string<\App\Estate>
     */
    protected $model = Estate::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = $this->ukUsPerson();
        $address = $this->ukUsAddress();

        return [
            'estate_user_id' => User::factory(),
            'estate_name' => fake()->randomElement(['Family Home', 'Lake View Property', 'Oakwood Estate', 'City Apartment', 'Hill Country House', 'Brookside Cottage']),
            'estate_owner_name' => $person['first'] . ' ' . $person['last'],
            'estate_address' => $address['address'],
            'estate_address2' => $address['address2'],
            'estate_city' => $address['city'],
            'estate_zip' => $address['zip'],
            'estate_state' => $address['state'],
            'estate_notes' => fake()->optional(0.5)->sentence(),
            'estate_is_primary_residence' => fake()->boolean(45) ? 1 : 0,
            'estate_does_own_home' => fake()->boolean(80) ? 1 : 0,
            'estate_image' => '',
            'action_on' => 'Estate',
        ];
    }
}
