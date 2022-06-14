<?php

namespace App\Http\Controllers\Inquiry;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest;
use App\Models\Inquiry;
use App\Models\InquiriyComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::orderBy('id', 'DESC')->paginate(10);

        return view('inquiry.index')
            ->with('inquiries', $inquiries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $inquiry = new Inquiry();

        return view('inquiry.create')
            ->with('user', $user)
            ->with('inquiry', $inquiry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InquiryRequest $request)
    {
        $user = Auth::user();

        $inquiry = Inquiry::create([
            'name' => $request->input('qna-name'),
            'description' => $request->input('qna-description'),
            'user_id' => $user->id,
            'secret' => $request->input('qna-name'),
        ]);

        //secret
        if ($request->has('qna-secret')) {
            $secret = $request->input('qna-secret');
            $inquiry->secret = Hash::make($secret);
            $inquiry->save();
        }

        return redirect(route('qna.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $inquiry = Inquiry::find($id);
        if (empty($inquiry)) {
            return redirect(route('qna.index'));
        }

        $comments = InquiriyComment::where('inquiries_id', $id)->orderBy('id', 'DESC')->get();
        $newComment = new InquiriyComment();

        return view('inquiry.show')
            ->with('inquiry', $inquiry)
            ->with('comments', $comments)
            ->with('newComment', $newComment)
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $inquiry = Inquiry::find($id);

        return view('inquiry.update')
            ->with('user', $user)
            ->with('inquiry', $inquiry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InquiryRequest $request, $id)
    {
        $inquiry = Inquiry::find($id);
        //name
        $inquiry->name = $request->input('qna-name');

        //description
        $inquiry->description = $request->input('qna-description');

        //user_id
        $user = Auth::user();
        $inquiry->user_id = $user->id;

        //secret
        if ($request->has('qna-secret')) {
            $secret = $request->input('qna-secret');
            $inquiry->secret = Hash::make($secret);
        }

        $inquiry->save();

        return redirect(route('qna.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inquiry::destroy($id);
        return redirect(route('qna.index'));
    }
}
