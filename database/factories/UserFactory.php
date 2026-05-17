<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\User>
 */
class UserFactory extends Factory
{
    use UkUsFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\User>
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = $this->ukUsPerson();

        return [
            'first_name' => $person['first'],
            'last_name' => $person['last'],
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$12$zCAyJs5G5MNlTHL/YKpVcOCLiM4GrcoDaeCvQR4Z2EbrrY2TVnoYW',
            'remember_token' => Str::random(10),
            'user_status' => 1,
            'spouse_logged' => 0,
            'user_sessions_last_active' => null,
            'user_access' => fake()->boolean(15) ? 1 : 0,
            'action_on' => 'User',
        ];
    }
}
