<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.all_category', [
            'categories' => $categories
        ]);
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3|max:65',
        ]);
        BlogCategory::create([
            'category_name' => $request->category_name,
            //category_slug
            'category_slug' => Str::slug($request->category_name, '-'),
        ]);

        $notification = array(
            'message' => 'Review Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        return response()->json($category);
    }

    public function UpdateBlogCategory(Request $request)
    {
        $category_id = $request->cat_id;
        $request->validate([
            'category_name' => 'required|min:3|max:65',
        ]);

        BlogCategory::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            //category_slug
            'category_slug' => Str::slug($request->category_name, '-'),
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog.category')->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
