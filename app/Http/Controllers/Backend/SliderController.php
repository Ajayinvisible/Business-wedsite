<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function GetSlider()
    {
        $slider = Slider::firstOrFail();
        return view('admin.backend.slider.get_slider', [
            'slider' => $slider
        ]);
    }
    //end method

    public function UpdateSlider(Request $request, $id)
    {
        // Logic to update a review
        $rev_id = $request->id;
        $slider = Slider::findOrFail($rev_id); 
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/slider');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(306, 618)->toWebp(80)->save(public_path('upload/slider/' . $name_gen));
            $save_url = 'upload/slider/' . $name_gen;

            if(file_exists(public_path($slider->image))){
                unlink(public_path($slider->image));
            }

            Slider::find($rev_id)->update([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'image' => $save_url,
            ]);
            // Redirect to the all slider page with a success message
            $notification = array(
                'message' => 'Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Slider::find($rev_id)->update([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
            ]);
            // Redirect to the all slider page with a success message
            $notification = array(
                'message' => 'Review Updated Successfully Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    // end update review method

    public function EditSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        
        if($request->has('title')){
            $slider->title = $request->title;
        }

        if($request->has('description')){
            $slider->description = $request->description;
        }

        $slider->save();
        return response()->json(['success' => true]);
    }


    public function EditFeatures(Request $request, $id)
    {
        $title = Title::findOrFail($id);

        if ($request->has('features')) {
            $title->features = $request->features;
        }

        $title->save();
        return response()->json(['success' => true]);
    }

    public function EditReview(Request $request, $id)
    {
        $title = Title::findOrFail($id);

        if ($request->has('review')) {
            $title->review = $request->review;
        }

        $title->save();
        return response()->json(['success' => true]);
    }
}
