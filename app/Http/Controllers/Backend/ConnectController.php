<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Connect;
use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function AllConnect()
    {
        // Logic to retrieve all features
        $connects = Connect::latest()->get();
        // Return the view with the features data
        return view('admin.backend.connect.all_connect', [
            'connects' => $connects
        ]);
    }

    public function AddConnect()
    {
        // Logic to show the form for adding a new feature
        return view('admin.backend.connect.add_connect');
    }

    public function StoreConnect(Request $request)
    {
        Connect::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Connect Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.connect')->with($notification);
    }

    public function EditConnect($id)
    {
        // Logic to show the form for editing a review
        $connect = Connect::findOrFail($id);
        return view('admin.backend.connect.edit_connect', compact('connect'));
    }


    public function UpdateConnect(Request $request, $id)
    {
        // Logic to update a review
        $con_id = $request->id;

        Connect::find($con_id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Connect Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.connect')->with($notification);
    }

    public function DeleteConnect($id)
    {
        Connect::findOrFail($id)->delete();
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Connect Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.connect')->with($notification);
    }

    public function EditConnectInline(Request $request, $id)
    {
        $connect = Connect::findOrFail($id);

        $connect->update($request->only('title', 'description'));
        return response()->json(['success' => true, 'message' => 'Connect updated successfully.']);
    }
}
