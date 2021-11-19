<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{
    public function input()
    {
        $images = Image::paginate(8);

        return response()->json([
            'image' => $images
        ], 200);
    }

    public function upload(Request $request)

    
    {
        $this->validate($request, [
            // 'file' => [
            //     'required',
            //     'file',
            //     'image',
            //     'mimes:jpg,png',
            //     'max:2048'
            // ]
            ]);

        // $fileImage = $request->file_name;
        $imageCount = Image::count() + 1;
        $file =  $request->file('file_name');
        $fileImage = $file->getClientOriginalName();
        $fileImage = $imageCount.$fileImage;
        
        if ($fileImage) {
            $file->storeAs('public/products', $fileImage);
            $fileTop = 'storage/products/';
            $fileImagePath = $fileTop.$fileImage;
        } else {
            $fileImagePath = "";
        }

        $data = [
            'file_name' => $fileImagePath
        ];

        Image::create($data);
    }

    public function show(Request $request)
    {
        $image = Image::where('id', $request->id)->first();
        return response()->json([
            'image' => $image
        ], 200);
    }
}
