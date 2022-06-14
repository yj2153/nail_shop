<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\PrimaryCategory;
use App\Traits\ImageUpload;

class ItemController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Item::paginate(10);

        return view('item.index')
            ->with('Products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PrimaryCategory::query()
            ->with([
                'secondaryCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        //sell.blade.php
        return view('item.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = Item::create([
            'name' => $request->input('sell-name'),
            'description' => $request->input('sell-description'),
            'secondary_category_id' => $request->input('sell-category'),
            'price' => $request->input('sell-price'),
        ]);

        //image file
        if ($request->has('sell-image')) {
            $file = $request->file('sell-image');
            if (empty($item->image_file_name) || $item->image_file_name != basename($file)) {
                $fileName = $this->saveImage($file, 200, 200, 'item', $item->image_file_name);
                $item->image_file_name = $fileName;
            }
        }

        $item->save();

        return redirect()->back()
            ->with('status', 'sell Edit Success');
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
        $item = Item::find($id);
        if (empty($item)) {
            return redirect()->route('item.index');
        }

        return view('item.show')
            ->with('user', $user)
            ->with('item', $item);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);

        return redirect(route('item.index'));
    }
}
