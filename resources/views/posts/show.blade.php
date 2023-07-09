<!DOCTYPE HTML>  
      <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Posts</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            </x-slot>
                 <h1>詳細画面</h1>
            <div>
                <p>タイトル：{{ $post->title }}</p>
                <p>本文：{{ $post->body }}</p>
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
            </div>
            <div>
                <p class="edit">[<a href="/posts/{{ $post->id }}/edit">編集</a>]</p>
                <a href="/">戻る</a>
            </div>
    </x-app-layout>
</html>
