<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\Cost;
use App\Models\Comment;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post, Prefecture $prefecture, Cost $cost)
    {

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
        $user = $request->user();
        $input += ['user_id' => $user->id]; 
        $post = new Post();
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
    
    public function comment(Request $request, Post $post)
    {
        $user = $request->user();
        $comment = new Comment();
        $comment->body = $request->input('post_comment');
        $comment->user()->associate($user);
        $comment->post()->associate($post);
        $comment->save();
        
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}

}
