<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        　　<div style= padding: 0.5em 1em;
    margin: 2em 0;
    color: #474747;
    background: whitesmoke;/*背景色*/
    border-left: double 7px #4ec4d3;/*左線*/
    border-right: double 7px #4ec4d3;/*右線*/>
            <title>Posts</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            </x-slot>
                 <h1>詳細画面</h1>
            <div>
                @foreach($posts as $post)
                    <p>タイトル：{{ $post->title }}</p>
                    <p>本文：{{ $post->body }}</p>
                    @foreach($post->comments as $comment)
                        <p>コメント：{{ $comment->body }}></p>
                    @endforeach
                    <p class="edit">[<a href="/posts/{{ $post->id }}/edit">編集</a>]</p>
                @endforeach
            </div>
            <div>
                <a href="/">戻る</a>
            </div>
            </div>
    </x-app-layout>
</html>
