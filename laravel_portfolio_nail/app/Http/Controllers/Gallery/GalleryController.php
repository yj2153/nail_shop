<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Traits\ImageUpload;

class GalleryController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::OrderBy('id', "DESC")->paginate(10);

        return view('gallery.index')
            ->with('gallerys', $galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $gallery = new Gallery();

        return view('gallery.create')
            ->with('user', $user)
            ->with('gallery', $gallery);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = Gallery::create([
            'name' => $request->input('gallery-name'),
            'description' => $request->input('gallery-description'),
        ]);

        //image file
        if ($request->has('gallery-image')) {
            $file = $request->file('gallery-image');
            if (empty($gallery->image_file_name) || $gallery->image_file_name != basename($file)) {
                $fileName = $this->saveImage($file, 200, 200, 'gallery', $gallery->image_file_name);
                $gallery->image_file_name = $fileName;
            }
        }
        $gallery->save();

        return redirect()->route('gallery.index');
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
        $gallery = Gallery::find($id);
        if (empty($gallery)) {
            return redirect(route('gallery.index'));
        }

        //prev id
        $gallery_prev = Gallery::where('id', '<', $gallery->id)->orderBy('id', 'DESC')->first();
        //next id
        $gallery_next = Gallery::where('id', '>', $gallery->id)->orderBy('id', 'ASC')->first();

        return view('gallery.show')
            ->with('user', $user)
            ->with('gallery', $gallery)
            ->with('gallery_prev', $gallery_prev)
            ->with('gallery_next', $gallery_next);
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
        $gallery = Gallery::find($id);

        return view('gallery.update')
            ->with('user', $user)
            ->with('gallery', $gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        //name
        $gallery->name = $request->input('gallery-name');

        //image file
        if ($request->has('gallery-image')) {
            $file = $request->file('gallery-image');
            if (empty($gallery->image_file_name) || $gallery->image_file_name != basename($file)) {
                $fileName = $this->saveImage($file, 200, 200, 'gallery', $gallery->image_file_name);
                $gallery->image_file_name = $fileName;
            }
        }

        //description
        $gallery->description = $request->input('gallery-description');
        $gallery->save();

        return redirect(route('gallery.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);

        return redirect(route('gallery.index'));
    }
}
