<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FullCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startDate = date("Ymd", mktime(0, 0, 0, intval(date('m')), 1, intval(date('Y'))));
        $endDate = date("Ymd", mktime(0, 0, 0, intval(date('m')) + 1, 0, intval(date('Y'))));
        $schedules = Schedule::whereBetween('start', [$startDate . ' 00:00:00', $endDate . ' 00:00:00'])->get();

        //user list
        $users = User::where('authority', 0)->get();

        //hour list
        $hours =  array();
        $cnt = 0;
        for ($i = 9; $i <= 20; $i++, $cnt++) {
            $hours[$cnt] = $i;
        }

        //minute list
        $minutes =  [0, 30];

        $colors = [
            'Summer Sky',
            'Lavender',
            'Thistle',
            'Plum',
            'Orchid',
            'Violet',
            'Coral',
            'LightYellow',
            'LemonChiffon',
            'LightGoldenRodYellow',
            'PapayaWhip',
            'Moccasin',
            'PeachPuff',
            'PaleGoldenRod',
            'Khaki',
            'HoneyDew',
            'MintCream',
            'Azure',
            'AliceBlue',
            'GhostWhite',
            'WhiteSmoke',
            'SeaShell',
            'Beige',
            'OldLace',
            'FloralWhite',
            'Ivory',
            'AntiqueWhite',
            'Linen',
            'LavenderBlush',
            'MistyRose',
        ];

        return view('mypage.fullcalendar.index')
            ->with('data', $schedules)
            ->with('users', $users)
            ->with('hours', $hours)
            ->with('minutes', $minutes)
            ->with('colors', $colors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'calendar-title' => ['required', 'string', 'max:255'],
            'calendar-start-hour' => ['required'],
            'calendar-start-minute' => ['required'],
            'calendar-user' => ['required'],
        ]);

        if ($validator->fails()) {
            return json_encode(array('result' => 'error', 'error' => $validator->errors()));
        }

        //YYYMMDD
        $YYYMMDD = explode('-', $request->input('calendar-ymd'));

        //start time
        $startH = $request->input('calendar-start-hour');
        $startM = $request->input('calendar-startd-minute');
        $start_time =  mktime(intval($startH), intval($startM), 0, intval($YYYMMDD[1]), intval($YYYMMDD[2]), intval($YYYMMDD[0]));
        $startDate = Carbon::createFromTimestamp($start_time);

        //end time
        $endH = $request->input('calendar-end-hour');
        $endM = $request->input('calendar-end-minute');
        $endDate = null;
        if (!empty($endH) && !empty($end)) {
            $end_time =  mktime(intval($endH), intval($endM), 0, intval($YYYMMDD[1]), intval($YYYMMDD[2]), intval($YYYMMDD[0]));
            $endDate = Carbon::createFromTimestamp($end_time);
        }

        //user id
        $userId = $request->input('calendar-user');

        //Schedule id
        $id = $request->input('calendar-id');

        $model = $this->getSchedule($id);
        $model->user_id = intval($userId);
        $model->start = $startDate;
        if (!empty($endDate)) {
            $model->end = $endDate;
        }
        $model->title = $request->input('calendar-title');
        $model->save();

        return json_encode(array('result' => 'success', 'model' => $model));
    }

    /**
     * 
     */
    private function getSchedule($id): Schedule
    {
        if (!empty($id)) {
            return Schedule::find($id);
        }

        $model = new Schedule;

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id yyyy-mm-dd
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yyyymmdd = explode('-', $id);
        $startDate = $yyyymmdd[0] . '/' . $yyyymmdd[1] . '/01';
        $endDate = $yyyymmdd[0] . '/' . ($yyyymmdd[1] + 1) . '/01';
        $schedules = Schedule::whereBetween('start', [$startDate . ' 00:00:00', $endDate . ' 00:00:00'])->get();


        return json_encode($schedules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedules = Schedule::find($id);

        return json_encode($schedules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //start time
        $start =  date('Y-m-d H:i', strtotime(strstr($request->calendarStart, 'GMT', true)));

        //end time
        $end = date('Y-m-d H:i', strtotime(strstr($request->calendarEnd, 'GMT', true)));

        //Schedule id
        $id = $request->input('calendar-id');

        $model = Schedule::find($id);
        $model->start = Carbon::createFromFormat('Y-m-d h:i', $start);
        $model->end = Carbon::createFromFormat('Y-m-d h:i', $end);
        $model->save();

        return json_encode(array('result' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Schedule::destroy($id);
        return json_encode(array('result' => 'success'));
    }
}
