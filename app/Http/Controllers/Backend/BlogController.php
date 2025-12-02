<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
// image intervention library for image manipulation
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
            'message' => 'Rev Added Successfully',
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

    // Blog Methods Start Here

    public function AllBlog()
    {
        $blogs = BlogPost::latest()->with('category')->get();
        return view('admin.backend.blog.all_blog', [
            'blogs' => $blogs
        ]);
    }

    public function AddBlog()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.blog.add_blog', [
            'categories' => $categories
        ]);
    }

    public function StoreBlog(Request $request)
    {
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/blog');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(746, 500)->toWebp(80)->save(public_path('upload/blog/' . $name_gen));
            $save_url = 'upload/blog/' . $name_gen;

            BlogPost::create([
                'blog_cat_id' => $request->blog_cat_id,
                'post_title' => $request->post_title,
                'post_slug' => Str::slug($request->post_title, '-'),
                'post_description' => $request->post_description,
                'image' => $save_url,
            ]);
        }

        // Redirect to the all blogs page with a success message
        $notification = array(
            'message' => 'Blog Post Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blog = BlogPost::findOrFail($id);
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.blog.edit_blog', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    public function UpdateBlog(Request $request, $id)
    {
        // Logic to update a blog
        $blog_id = $request->id;
        // image upload and resizing logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . "webp";

            $uploadPath = public_path('upload/blog');

            // Check if the folder exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // 0755 permission, recursive
            }

            $img = $manager->read($image);
            // Resize the image to 60x60 pixels and save it as webp format with 80% quality 
            $img->resize(746, 500)->toWebp(80)->save(public_path('upload/blog/' . $name_gen));
            $save_url = 'upload/blog/' . $name_gen;

            BlogPost::find($blog_id)->update([
                'blog_cat_id' => $request->blog_cat_id,
                'post_title' => $request->post_title,
                'post_slug' => Str::slug($request->post_title, '-'),
                'post_description' => $request->post_description,
                'image' => $save_url,
            ]);
            // Redirect to the all blogs page with a success message
            $notification = array(
                'message' => 'Blog Post Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        } else {
            BlogPost::find($blog_id)->update([
                'blog_cat_id' => $request->blog_cat_id,
                'post_title' => $request->post_title,
                'post_slug' => Str::slug($request->post_title, '-'),
                'post_description' => $request->post_description,
            ]);
            // Redirect to the all blogs page with a success message
            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function DeleteBlog($id)
    {
        $item = BlogPost::findOrFail($id);
        $imagePath = public_path($item->image);
        unlink($imagePath); // Delete the image file from the server

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog')->with($notification);
    }
}
