<?php

namespace Database\Seeders;

use App\Estate;
use App\User;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->get();

        if ($users->isEmpty()) {
            $users = User::factory()->count(20)->create();
        }

        Estate::factory()
            ->count(30)
            ->sequence(fn ($sequence) => ['estate_user_id' => $users->random()->id])
            ->create();
    }
}
