<?php

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class)->create([
            'secondary_category_id'    => 1,
            'name' => '10만원',
            'description' => "회원권 10만원 \n110,000원→100,000원(10%할인)\n\n구매 후, 예약상담을 위해 전화번호를 반드시 입력해주세요.",
            'price' => 100000,
        ]);

        factory(Item::class)->create([
            'secondary_category_id'    => 2,
            'name' => '30만원',
            'description' => "회원권 30만원 \n360,000원→300,000원(20%할인)\n\n구매 후, 예약상담을 위해 전화번호를 반드시 입력해주세요.",
            'price' => 300000,
            'default' => 1,
        ]);
    }
}
