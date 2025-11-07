<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AppController extends Controller
{
    public function EditAppInline(Request $request, $id)
    {
        $app = App::findOrFail($id);

        $app->update($request->only('title', 'description'));
        return response()->json(['success' => true, 'message' => 'Connect updated successfully.']);
    }

    public function UploadAppImage(Request $request, $id)
    {
        $app = App::findOrFail($id);
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/app');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(306, 481)->toWebp(80)->save(public_path('upload/app/' . $name_gen));
            $save_url = 'upload/app/' . $name_gen;
            // Delete old image if exists
            if (File::exists(public_path($app->image))) {
                @unlink(public_path($app->image));
            }

            $app->update(['image' => $save_url]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully.',
                'image_url' => asset($save_url)
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No image uploaded.'], 400);
    }
}
