<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Review $post)
    {
        return view('reviews.index')->with(['posts' => $post->get()]);
    }
}
