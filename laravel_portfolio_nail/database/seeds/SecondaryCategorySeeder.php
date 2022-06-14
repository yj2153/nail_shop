<?php

use Illuminate\Database\Seeder;
use App\Models\SecondaryCategory;

class SecondaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SecondaryCategory::class)->create([
            'id'                  => 1,
            'name'                => '10만원',
            'sort_no'             => 1,
            'primary_category_id' => 1,
        ]);

        factory(SecondaryCategory::class)->create([
            'id'                  => 2,
            'name'                => '30만원',
            'sort_no'             => 2,
            'primary_category_id' => 1,
        ]);
    }
}
