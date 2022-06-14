<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Schedule::class)->create([
            'id'      => 1,
            'user_id'    => '2',
            'title' => 'user2예약',
            'start' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-04-17 10:00:00'),
            'color' => 'lightpink',
        ]);

        factory(Schedule::class)->create([
            'id'      => 2,
            'user_id'    => '2',
            'title' => 'user2예약',
            'start' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-04-18 10:00:00'),
            'color' => 'lightgreen',
        ]);


        factory(Schedule::class)->create([
            'id'      => 3,
            'user_id'    => '1',
            'title' => 'user1예약',
            'start' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-05-18 10:00:00'),
            'color' => 'blue',
        ]);
    }
}
