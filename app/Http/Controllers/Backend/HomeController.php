<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function AllFeature()
    {
        // Logic to retrieve all features
        $features = Feature::latest()->get();
        // Return the view with the features data
        return view('admin.backend.feature.all_feature', [
            'features' => $features
        ]);
    }

    public function AddFeature()
    {
        // Logic to show the form for adding a new feature
        return view('admin.backend.feature.add_feature');
    }

    public function StoreFeature(Request $request)
    {
        Feature::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Review Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.feature')->with($notification);
    }

    public function EditFeature($id)
    {
        // Logic to show the form for editing a review
        $feature = Feature::findOrFail($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));
    }


    public function UpdateFeature(Request $request, $id)
    {
        // Logic to update a review
        $rev_id = $request->id;

        Feature::find($rev_id)->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Feature Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.feature')->with($notification);
    }

    public function DeleteFeature($id)
    {
        Feature::findOrFail($id)->delete();
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Feature Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.feature')->with($notification);
    }
}
