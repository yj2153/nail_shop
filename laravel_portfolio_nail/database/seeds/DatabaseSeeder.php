<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
        $this->call(PrimaryCategorySeeder::class);
        $this->call(SecondaryCategorySeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(InquirySeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
