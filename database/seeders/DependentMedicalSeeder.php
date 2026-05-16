<?php

namespace Database\Seeders;

use App\DependentMedical;
use App\Member;
use Illuminate\Database\Seeder;

class DependentMedicalSeeder extends Seeder
{
    public function run(): void
    {
        Member::query()
            ->where('member_is_dependent', 1)
            ->whereDoesntHave('dependent_medical')
            ->get()
            ->each(function (Member $member): void {
                DependentMedical::factory()->create([
                    'dependent_medical_member_id' => $member->member_id,
                ]);
            });
    }
}
