<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Contact;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function OurTeam()
    {
        return view('home.team.team_page');
    }

    public function AboutUs()
    {
        return view('home.about.about_page');
    }

    public function BlogPage()
    {
        $blogCategories = BlogCategory::withCount('posts')->latest()->get();
        $posts = BlogPost::latest()->limit(5)->get();
        $recentPost = BlogPost::latest()->paginate(3);
        return view('home.blog.list_blog', [
            'blogCategories' => $blogCategories,
            'posts' => $posts,
            'recentPost' => $recentPost,
        ]);
    }

    public function BlogDetails($slug)
    {
        $blogCategories = BlogCategory::withCount('posts')->latest()->get();
        $post = BlogPost::where('post_slug', $slug)->firstOrFail();
        $relatedPosts = BlogPost::where('blog_cat_id', $post->blog_cat_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(3)
            ->get();
        return view('home.blog.blog_details', [
            'blogCategories' => $blogCategories,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function blogCategoryPage($slug)
    {
        $blogCategories = BlogCategory::withCount('posts')->latest()->get();
        $category = BlogCategory::where('category_slug', $slug)->firstOrFail();
        $posts = BlogPost::where('blog_cat_id', $category->id)->latest()->paginate(5);
        $recentPost = BlogPost::latest()->paginate(3);
        return view('home.blog.category_blog', [
            'blogCategories' => $blogCategories,
            'category' => $category,
            'posts' => $posts,
            'recentPost' => $recentPost,
        ]);
    }

    public function ContactUs()
    {
        return view('home.contact.contact_page');
    }

    public function ContactMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Contact Message Sent Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
