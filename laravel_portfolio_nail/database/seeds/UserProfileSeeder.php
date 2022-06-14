<?php

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserProfile::class)->create([
            'user_id' => 1,
            'phone' => '01012341234'
        ]);

        factory(UserProfile::class)->create([
            'user_id' => 2,
            'phone' => '01012341234'
        ]);
    }
}
