<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>プロフィール</h1>
        <div>
            <p>ユーザーネーム：{{ $user->name }}</p>
            <p>自己紹介：</p>
            <p>ユーザーネーム：{{ $user->name }}</p>
            @foreach ($posts as $post)
                <div style='border:solid 1px; margin-bottom: 10px;'>
                    <p>
                        タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </p>
                    <p>本文：{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
    </body>
</html>
