<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// image intervention library for image manipulation
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TeamController extends Controller
{
    public function AllTeam()
    {
        // Logic to retrieve all reviews
        $teams = Team::latest()->get();
        return view('admin.backend.team.all_team', [
            'teams' => $teams
        ]);
    }

    public function AddTeam()
    {
        // Logic to show the form for adding a new review
        return view('admin.backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/team');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(306, 400)->toWebp(80)->save(public_path('upload/team/' . $name_gen));
            $save_url = 'upload/team/' . $name_gen;

            Team::create([
                'name' => $request->name,
                'position' => $request->position,
                'image' => $save_url,
            ]);
        }

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Team Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }

    public function EditTeam($id)
    {
        // Logic to show the form for editing a review
        $team = Team::findOrFail($id);
        return view('admin.backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request, $id)
    {
        // Logic to update a review
        $tem_id = $request->id;
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/team');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(306, 400)->toWebp(80)->save(public_path('upload/team/' . $name_gen));
            $save_url = 'upload/team/' . $name_gen;

            Team::find($tem_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'image' => $save_url,
            ]);
            // Redirect to the all teams page with a success message
            $notification = array(
                'message' => 'Team Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);
        } else {
            Team::find($tem_id)->update([
                'name' => $request->name,
                'position' => $request->position,
            ]);
            // Redirect to the all teams page with a success message
            $notification = array(
                'message' => 'Team Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);
        }
    }

    public function DeleteTeam($id)
    {
        $item = Team::findOrFail($id);
        $imagePath = public_path($item->image);
        unlink($imagePath); // Delete the image file from the server

        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Team Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }
}
