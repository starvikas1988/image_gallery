<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:50'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'image_url' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
        ]);

        return redirect()->route('images.index')
            ->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:50'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->image_url);
            $imagePath = $request->file('image')->store('images', 'public');
            $image->image_url = $imagePath;
        }

        $image->title = $request->title;
        $image->description = $request->description;
        $image->tag = $request->tag;
        $image->save();

        return redirect()->route('images.index')
            ->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        return redirect()->route('images.index')
            ->with('success', 'Image deleted successfully.');
    }
}
