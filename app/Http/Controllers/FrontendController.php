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
        return view('home.blog.list_blog',[
            'blogCategories' => $blogCategories,
            'posts' => $posts,
        ]);
    }
}
