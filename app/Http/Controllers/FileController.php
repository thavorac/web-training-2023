<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request) {
        // dd($request->all());
        $path = $request->file('photo')->store('public');

        $toSave = new Photo();
        $toSave->photo = $path;
        $toSave->save();
        return ["message" => "success"];
    }

    public function list(Request $request) {
        $photos = Photo::all();
        return view('list_photos', compact('photos'));
    }

    public function edit(Request $request) {
        $photo = Photo::where('id', $request->photoId)->first();
        return view('edit_upload_file', compact('photo'));
    }

    public function update_upload(Request $request) {
        $photo = Photo::where('id', $request->photoId)->first();
        $newPath = $request->file('photo')->store('public');

        // Delete file first
        Storage::delete($photo->photo);

        // Update link for new file
        $photo->photo = $newPath;
        $photo->save();

        return ["message" => 'success'];
    }
}
