<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Traits\ImageUpload;

class ProfileController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mypage.profile.index')
            ->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditRequest $request)
    {
        $authUser = Auth::user();
        $user = User::find($authUser->id);

        //name
        $user->name = $request->input('name');
        $authUser->name = $user->name;

        //phone
        $user->profile->phone = $request->input('phone');

        //image file
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            if (empty($user->profile->avatar_file_name) || $user->profile->avatar_file_name != basename($file)) {
                $fileName = $this->saveImage($file, 200, 200, 'avatars', $user->profile->avatar_file_name);
                $user->profile->avatar_file_name = $fileName;
            }
        }

        //save
        $user->save();
        $user->profile->save();

        return redirect()->back()
            ->with('status', 'profile Edit Success');
    }
}
