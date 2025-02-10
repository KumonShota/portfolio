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

    public function create()
    {
        return view('reviews.create');
    }
    public function store(Request $request, Review $post)
    {
        $input = $request->all();
        $input['user_id'] = auth()->id();
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function show(Review $post)
    {
        return view('reviews.show')->with(['post' => $post]);
    }
}
