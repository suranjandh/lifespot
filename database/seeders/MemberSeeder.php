<?php

namespace Database\Seeders;

use App\Member;
use App\User;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->pluck('id');

        if ($users->isEmpty()) {
            $users = User::factory()->count(20)->create()->pluck('id');
        }

        Member::factory()
            ->count(70)
            ->sequence(fn ($sequence) => ['member_owner_user_id' => $users->random()])
            ->create();

        Member::factory()
            ->dependent()
            ->count(30)
            ->sequence(fn ($sequence) => ['member_owner_user_id' => $users->random()])
            ->create();
    }
}
