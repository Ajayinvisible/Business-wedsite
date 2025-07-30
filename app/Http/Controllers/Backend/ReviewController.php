<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function AllReview()
    {
        // Logic to retrieve all reviews
        $reviews = Review::latest()->get();
        // Return the view with the reviews data
        return view('admin.backend.review.all_review',[
            'reviews' => $reviews
        ]);
    }

    public function AddReview()
    {
        // Logic to show the form for adding a new review
        return view('admin.backend.review.add_review');
    }
}
