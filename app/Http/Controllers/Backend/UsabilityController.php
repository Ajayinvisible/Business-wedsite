<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Usability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class UsabilityController extends Controller
{
    public function GetUsability()
    {
        $usability = Usability::firstOrFail();
        return view('admin.backend.usability.get_usability', [
            'usability' => $usability
        ]);
    }


    public function UpdateUsability(Request $request, $id)
    {
        // Logic to update a review
        $use_id = $request->id;
        $usability = Usability::findOrFail($use_id);
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/usability');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 302x618 pixels and save it as webp format with 80% quality 
            $img->resize(560, 400)->toWebp(80)->save(public_path('upload/usability/' . $name_gen));
            $save_url = 'upload/usability/' . $name_gen;

            if (file_exists(public_path($usability->image))) {
                unlink(public_path($usability->image));
            }

            Usability::find($use_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'youtube_link' => $request->youtube_link,
                'image' => $save_url,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'Usability Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Usability::find($use_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'youtube_link' => $request->youtube_link,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'Usability Updated Successfully Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function EditUsability(Request $request, $id)
    {
        $usability = Usability::findOrFail($id);

        if ($request->has('title')) {
            $usability->title = $request->title;
        }

        if ($request->has('description')) {
            $usability->description = $request->description;
        }

        $usability->save();
        return response()->json(['success' => true]);
    }
}
