<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{
    public function GetAbout()
    {
        $about = About::firstOrFail();
        return view('admin.backend.about.get_about', [
            'about' => $about
        ]);
    }
    //end method

    public function UpdateAbout(Request $request, $id)
    {
        // Logic to update a review
        $rev_id = $request->id;
        $about = About::findOrFail($rev_id);
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/about');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(526, 550)->toWebp(80)->save(public_path('upload/about/' . $name_gen));
            $save_url = 'upload/about/' . $name_gen;

            if (file_exists(public_path($about->image))) {
                unlink(public_path($about->image));
            }

            About::find($rev_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,
            ]);
            // Redirect to the all about page with a success message
            $notification = array(
                'message' => 'About Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            About::find($rev_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            // Redirect to the all about page with a success message
            $notification = array(
                'message' => 'Review Updated Successfully Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    // end update review method

    public function EditAbout(Request $request, $id)
    {
        $about = About::findOrFail($id);

        if ($request->has('title')) {
            $about->title = $request->title;
        }

        if ($request->has('description')) {
            $about->description = $request->description;
        }

        $about->save();
        return response()->json(['success' => true]);
    }

}
