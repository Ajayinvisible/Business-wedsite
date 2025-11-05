<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarifie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ClarifiesController extends Controller
{
    public function GetClarifies()
    {
        $clarifie = Clarifie::firstOrFail();
        return view('admin.backend.clarifie.get_clarifies', [
            'clarifie' => $clarifie
        ]);
    }

    public function UpdateClarifies(Request $request, $id)
    {
        // Logic to update a review
        $clear_id = $request->id;
        $clarifie = Clarifie::findOrFail($clear_id);
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/clearifie');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 302x618 pixels and save it as webp format with 80% quality 
            $img->resize(302, 618)->toWebp(80)->save(public_path('upload/clearifie/' . $name_gen));
            $save_url = 'upload/clearifie/' . $name_gen;

            if (file_exists(public_path($clarifie->image))) {
                unlink(public_path($clarifie->image));
            }

            Clarifie::find($clear_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'clearifie Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Clarifie::find($clear_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'Review Updated Successfully Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function EditClarifies(Request $request, $id)
    {
        $clarifie = Clarifie::findOrFail($id);

        if ($request->has('title')) {
            $clarifie->title = $request->title;
        }

        if ($request->has('description')) {
            $clarifie->description = $request->description;
        }

        $clarifie->save();
        return response()->json(['success' => true]);
    }
}
