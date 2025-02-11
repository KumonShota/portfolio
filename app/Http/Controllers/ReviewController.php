<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewRequest;
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
    public function store(ReviewRequest $request, Review $post)
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
    public function edit(Review $post)
    {
        return view('reviews.edit')->with(['post' => $post]);
    }
    public function update(ReviewRequest $request, Review $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
}
