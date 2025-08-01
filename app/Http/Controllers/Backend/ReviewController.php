<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// image intervention library for image manipulation
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReviewController extends Controller
{
    public function AllReview()
    {
        // Logic to retrieve all reviews
        $reviews = Review::latest()->get();
        // Return the view with the reviews data
        return view('admin.backend.review.all_review', [
            'reviews' => $reviews
        ]);
    }
    // get all review method

    public function AddReview()
    {
        // Logic to show the form for adding a new review
        return view('admin.backend.review.add_review');
    }
    // add review view method

    public function StoreReview(Request $request)
    {
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/review');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(60, 60)->toWebp(80)->save(public_path('upload/review/' . $name_gen));
            $save_url = 'upload/review/' . $name_gen;

            Review::create([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,
            ]);
        }

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Review Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.review')->with($notification);
    }
    //end store review method

    public function EditReview($id)
    {
        // Logic to show the form for editing a review
        $review = Review::findOrFail($id);
        return view('admin.backend.review.edit_review', compact('review'));
    }
    // edit review view method

    public function UpdateReview(Request $request, $id)
    {
        // Logic to update a review
        $rev_id = $request->id;
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/review');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(60, 60)->toWebp(80)->save(public_path('upload/review/' . $name_gen));
            $save_url = 'upload/review/' . $name_gen;

            Review::find($rev_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,
            ]);
            // Redirect to the all reviews page with a success message
            $notification = array(
                'message' => 'Review Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.review')->with($notification);
        } else {
            Review::find($rev_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
            ]);
            // Redirect to the all reviews page with a success message
            $notification = array(
                'message' => 'Review Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.review')->with($notification);
        }
    }
    // end update review method

    public function DeleteReview($id)
    {
        $item = Review::findOrFail($id);
        $imagePath = public_path($item->image);
        unlink($imagePath); // Delete the image file from the server

        Review::findOrFail($id)->delete();
        // Redirect to the all reviews page with a success message
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.review')->with($notification);
    }
}
