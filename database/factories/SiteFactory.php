<?php

namespace Database\Factories;

use App\Site;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Site>
 */
class SiteFactory extends Factory
{
    use SriLankanFaker;

    /**
     * @var class-string<\App\Site>
     */
    protected $model = Site::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = $this->sriLankanPerson();

        return [
            'site_owner_user_id' => User::factory(),
            'site_name' => fake()->randomElement(['LifeSpot Family Vault', 'Colombo Estate Plan', 'Family Legacy Hub', 'Trust Documents Portal']),
            'site_owners' => $person['first'] . ' ' . $person['last'],
            'site_image' => '',
            'action_on' => 'Site',
        ];
    }
}
