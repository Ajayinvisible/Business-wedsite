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
}
