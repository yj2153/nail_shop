<?php

namespace App\Http\Controllers\Inquiry;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiriyCommentRequest;
use App\Models\InquiriyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\InquiriyCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InquiriyCommentRequest $request)
    {
        $user = Auth::user();
        $comment = new InquiriyComment();
        $comment->user_id = $user->id;
        $comment->inquiries_id = $request->input('inquiry_id');
        $comment->description = $request->input('comment-description');

        $comment->save();

        return redirect()->back();
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
    public function edit(Request $request, $id)
    {
        return redirect()->back()
            ->with('comment_edit', $request->input('comment_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InquiriyCommentRequest $request, $id)
    {
        $comment_id =  $request->input('comment_id');
        $comment = InquiriyComment::find($comment_id);
        $comment->description = $request->input('comment-description');
        $comment->save();

        $inquiry_id = $request->input('inquiry_id');

        return redirect(route('qna.show', ['qna' => $inquiry_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $routeId = $request->route()->parameter('comment');
        InquiriyComment::destroy($routeId);
        return redirect()->back();
    }
}
