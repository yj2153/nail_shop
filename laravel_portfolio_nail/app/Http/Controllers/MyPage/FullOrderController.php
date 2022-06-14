<?php

namespace App\Http\Controllers\MyPage;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Http\Requests\FullOrderRequest;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FullOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with([
            'orders' => function ($query) {
                $query->orderBy('id');
            }
        ])
            ->orderBy('id', 'DESC');

        $startDate = Request::input('startDate', date("Y/m/d"));
        $endDate = Request::input('endDate', date("Y/m/d"));

        if (!empty($startDate) && !empty($endDate)) {
            $payments->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $defaults = [
            'startDate' => $startDate,
            'endDate'  => $endDate,
        ];

        return view('mypage.fullOrder.index')
            ->with('payments', $payments->get())
            ->with('defaults', $defaults);
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

    public function testUpdate(Request $request)
    {
        return "testtesttest";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FullOrderRequest $request)
    {
        $post = $request->all();

        $response = new StreamedResponse(function () use ($request, $post) {

            $stream = fopen('php://output', 'w');

            // stream_filter_prepend($stream, 'convert.iconv.utf-8/cp949//TRANSLIT');

            //header
            fputcsv($stream, $this->csvHeader());

            //data
            $results = Payment::with([
                'orders' => function ($query) {
                    $query->orderBy('id');
                }
            ])->whereBetween('created_at', [$post['startDate'] . ' 00:00:00', $post['endDate'] . ' 23:59:59'])
                ->orderBy('id', 'DESC')
                ->get();

            if (empty($results[0])) {
                fputcsv($stream, [
                    'NO DATA',
                ]);
            } else {
                $count = 1;
                foreach ($results as $payment) {
                    foreach ($payment->orders as $order) {
                        fputcsv($stream, $this->csvRow($count++, $payment, $order));
                    }
                }
            }
            fclose($stream);
        });

        $response->headers->set('Content-Type', 'application/octet-stream;');

        $response->headers->set('content-disposition', 'attachment; filename=' . $post['startDate'] . '_' . $post['endDate'] . '_Order.csv');

        return $response;
    }

    /**
     * csv Header.
     * @param string lang
     */
    public function csvHeader($local = "ko")
    {
        $header = [
            'No',
            '이름',
            '전화번호',
            '주문번호',
            '상품명',
            '상태',
        ];

        return $header;
    }

    /**
     * csv Row.
     * @param int $id count
     * @param Payment $paymen
     * @param Order $order
     */
    public function csvRow($id, $paymen, $order)
    {
        return [
            $id,
            $paymen->user_name,
            $paymen->user_phone,
            $order->order_number,
            $order->name,
            '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $status =  Request::input('fullOrder-status');
        $payment = Payment::find($id);
        $payment->status = $status;
        if ($status === Payment::STATE_CANCEL) {
            $payment->cancel_price = $payment->total_price;
        }

        $payment->save();

        return redirect()->back()
            ->with('status', 'fullOrder Edit Success');
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
    }
}
