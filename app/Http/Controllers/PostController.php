<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\Cost;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = Post::all();
        $prefecture = Prefecture::all();
        $costs = Cost::all();
        return view('posts/index')->with(['posts' => $posts, 'prefectures' => $prefecture, 'costs' =>$costs]);
    }

    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }

    public function create()
    {
        $prefecture = Prefecture::all();
        $costs = Cost::all();
        return view('posts/create')->with(['prefectures' => $prefecture, 'costs' =>$costs]);
    }
    
    


    public function store(Request $request)
    {

        $input = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url]; 
        $post->fill($input)->save();
      
        $validatedData = $request->validate([
            'post_title' => 'required|string',
            'post_body' => 'required|string',
            'post_prefecture_id' => 'required',
            'post_cost_id' => 'required',
            'post_date' => 'required',
        ]);
        
        $user = $request->user();
        $prefectureId = $request->input('post_prefecture_id');
        $costId = $request->input('post_cost_id');
        $prefecture = Prefecture::findOrFail($prefectureId);
        $cost = Cost::findOrFail($costId);
        $date = $request->input('post_date');
        
        $post = new Post();
        $post->title = $request->input('post_title');
        $post->body = $request->input('post_body');
        $post->user()->associate($user);
        $post->prefecture()->associate($prefecture);
        $post->cost()->associate($cost);
        $post->date = $date;
        $post->save();

        return redirect('/posts/' . $post->id);
    }

    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }

}
