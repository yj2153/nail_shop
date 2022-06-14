<?php

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gallery::class)->create([
            'name'                => '네일 디자인 1',
            'description' => '네일 디자인입니다.',
            'default' => 1,
        ]);

        factory(Gallery::class)->create([
            'name'                => '네일 디자인 2',
            'description' => '네일 디자인입니다.',
        ]);
    }
}
