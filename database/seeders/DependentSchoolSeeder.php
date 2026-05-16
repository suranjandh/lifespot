<?php

namespace Database\Seeders;

use App\DependentSchool;
use App\Member;
use Illuminate\Database\Seeder;

class DependentSchoolSeeder extends Seeder
{
    public function run(): void
    {
        Member::query()
            ->where('member_is_dependent', 1)
            ->whereDoesntHave('dependent_school')
            ->get()
            ->each(function (Member $member): void {
                DependentSchool::factory()->create([
                    'dependent_school_member_id' => $member->member_id,
                ]);
            });
    }
}
