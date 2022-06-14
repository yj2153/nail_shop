<?php

namespace App\Http\Middleware;

use App\Models\Inquiry;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Closure;

class InquiryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route()->parameter('qna');
        $inquiry = Inquiry::find($id);
        $user = Auth::user();

        //신규작성일 경우
        if (empty($inquiry)) {
            return $next($request);
        }

        //작성자 본인일 경우
        if (Auth::check() && $user->id == $inquiry->user_id) {
            return $next($request);
        }

        //cookie에서 비밀번호 가져오기
        $password = $request->cookie('secret-password');

        //비밀글 체크
        if (!empty($inquiry->secret)) {
            if (empty($password) || !Hash::check($password, $inquiry->secret)) {
                return redirect(route('secret.index', ['qna' => $id]));
            }
        }

        return $next($request);
    }
}
