<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <!--旅行先と予算から検索するフォーム-->
        <form class="search">
            @csrf
        <select name="prefecture">
            <option value="">旅行先を選択してください</option>
            @foreach ($posts as $post)
                <option value="{{ $post->prefecture->id }}">{{ $post->prefecture->name }}</option>
            @endforeach
        </select>
        <select name="costs">
            <option value="">予算を選択してください</option>
            @foreach ($posts as $post)
                <option value="{{ $post->cost->id }}">{{ $post->cost->cost }}</option>
            @endforeach
        </select>
        <input type="buttun" value="検索"/>
        <h1>チーム開発会へようこそ！</h1>
        <h2>投稿一覧画面</h2>
        <a href='/posts/create'>新規投稿</a>
        <div>
            <table>
                <tbody>
                @foreach ($posts->chunk(3) as $chuck)
                    <tr>
                    @foreach($chunk as $post)
                        <td>
                        <p>
                            タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </p>
                        <p> 本文：<a href="/posts/{{ $post->id }}">{{ $post->body }}</a></p>
                        <p>カテゴリー：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                    @endforeach
                    </tr>
                @endforeach
                 </tbody>
            </table>
        </div>
        <div>
            {{ $posts->links() }}
        </div>
    </body>
</html>