<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\Cost;

class PostController extends Controller
{
    public function index(Post $post, Prefecture $prefecture, Cost $cost)
    {
        //dd($post->getPaginateByLimit()->find(1));
        return view('posts/index')->with([
            'posts' => $post->getPaginateByLimit(),
            'prefectures' => $prefecture->get(),
            'costs' => $cost->get()
            ]);
    }

    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }

    public function create(Prefecture $prefecture)
    {
        return view('posts/create')->with(['prefectures' => $prefecture->get()]);
        
        
    }
    


    public function store(Post $post, Request $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
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
