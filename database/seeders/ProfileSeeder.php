<?php

namespace Database\Seeders;

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        User::query()
            ->whereDoesntHave('profile')
            ->get()
            ->each(function (User $user): void {
                Profile::factory()->create([
                    'profile_user_id' => $user->id,
                    'profile_first_name' => $user->first_name,
                    'profile_last_name' => $user->last_name,
                    'profile_email' => $user->email,
                ]);
            });
    }
}
