<?php

use Illuminate\Database\Seeder;
use App\Models\PrimaryCategory;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PrimaryCategory::class)->create([
            'id'      => 1,
            'name'    => '회원권',
            'sort_no' => 1,
        ]);

        factory(PrimaryCategory::class)->create([
            'id'      => 2,
            'name'    => '상품',
            'sort_no' => 2,
        ]);
    }
}
