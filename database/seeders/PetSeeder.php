<?php

namespace Database\Seeders;

use App\Member;
use App\Pet;
use App\User;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->get();

        if ($users->isEmpty()) {
            $users = User::factory()->count(20)->create();
        }

        Pet::factory()
            ->count(50)
            ->sequence(function ($sequence) use ($users): array {
                $user = $users->random();
                $guardian = Member::query()
                    ->where('member_owner_user_id', $user->id)
                    ->inRandomOrder()
                    ->first();

                if (! $guardian) {
                    $guardian = Member::factory()->create([
                        'member_owner_user_id' => $user->id,
                    ]);
                }

                return [
                    'pet_owner_user_id' => $user->id,
                    'pet_guardian' => $guardian->member_id,
                ];
            })
            ->create();
    }
}
