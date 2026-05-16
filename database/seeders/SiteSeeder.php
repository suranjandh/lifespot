<?php

namespace Database\Seeders;

use App\Site;
use App\User;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        User::query()
            ->whereDoesntHave('site')
            ->get()
            ->each(function (User $user): void {
                Site::factory()->create([
                    'site_owner_user_id' => $user->id,
                    'site_owners' => trim($user->first_name . ' ' . $user->last_name),
                ]);
            });
    }
}
