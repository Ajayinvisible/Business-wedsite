<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FinancialController extends Controller
{
    public function GetFinancial()
    {
        $financial = Financial::firstOrFail();
        return view('admin.backend.financial.get_financial', [
            'financial' => $financial
        ]);
    }


    public function UpdateFinancial(Request $request, $id)
    {
        // Logic to update a review
        $clear_id = $request->id;
        $clarifie = Financial::findOrFail($clear_id);
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/financial');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 302x618 pixels and save it as webp format with 80% quality 
            $img->resize(307, 619)->toWebp(80)->save(public_path('upload/financial/' . $name_gen));
            $save_url = 'upload/financial/' . $name_gen;

            if (file_exists(public_path($clarifie->image))) {
                unlink(public_path($clarifie->image));
            }

            Financial::find($clear_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,
                'undefine_title' => $request->undefine_title,
                'undefine_icon' => $request->undefine_icon,
                'undefine_description' => $request->undefine_description,
                'real_title' => $request->real_title,
                'real_icon' => $request->real_icon,
                'real_description' => $request->real_description,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'clearifie Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Financial::find($clear_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'undefine_title' => $request->undefine_title,
                'undefine_icon' => $request->undefine_icon,
                'undefine_description' => $request->undefine_description,
                'real_title' => $request->real_title,
                'real_icon' => $request->real_icon,
                'real_description' => $request->real_description,
            ]);
            // Redirect to the all clearifie page with a success message
            $notification = array(
                'message' => 'Financial Updated Successfully Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function EditFinancial(Request $request, $id)
    {
        $financial = Financial::findOrFail($id);

        if ($request->has('title')) {
            $financial->title = $request->title;
        }

        if ($request->has('description')) {
            $financial->description = $request->description;
        }

        $financial->save();
        return response()->json(['success' => true]);
    }
}
