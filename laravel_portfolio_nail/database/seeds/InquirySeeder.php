<?php

use Illuminate\Database\Seeder;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Hash;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Inquiry::class)->create([
            'id'                  => 1,
            'user_id'             => 1,
            'name'                => 'test title',
            'description'         => 'test description',
            'secret' => Hash::make('1234'),
        ]);
    }
}
