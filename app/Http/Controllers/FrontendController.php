<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
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
        return view('home.blog.list_blog',[
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
}
