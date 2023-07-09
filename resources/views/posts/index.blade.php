<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <title>Blog</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            <link href="/css/layout.css" rel="stylesheet">
        </x-slot>
        
        <!--旅行先と予算から検索するフォーム-->
        <form class="search">
            @csrf
        <select name="prefecture">
            <option value="">旅行先</option>
            @foreach ($prefectures as $prefecture)

                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
            @endforeach
        </select>
        <select name="costs">
            <option value="">予算</option>

            @foreach ($costs as $cost)
                <option value="{{ $cost->id }}">{{ $cost->cost }}</option>
            @endforeach
        </select>
        <input type="submit" value="検索"/>

        <h1>チーム開発会へようこそ！</h1>
        <h2>投稿一覧画面</h2>
        <a href='/posts/create'>新規投稿</a>
        
        <div class="container">
        @foreach($posts as $post)
            <div class="postcontent">
                <div>
                <img src="{{ $post->image_url }} " alt="画像が読み込めません。"/>
                </div>
                <h2><a href="/posts/{{ $post->id }}">{{$post->title}}</a></h2>
                <p>{{$post->body}}</p><br>
                
                <div class="user">
                <a href="/users/{{ $post->user->id }}">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach
        </div>
        
        <div>
        
        </div>
    </x-app-layout>
</html>