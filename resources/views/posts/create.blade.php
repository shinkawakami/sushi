<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1></h1>
        <h2>投稿作成</h2>
        <form action="/posts" method="POST" enctype="multipart/form-data" style="border: 5px double #aaa;

  padding: 2em;">
            @csrf
            <div>
                <div>
                <h2 style="font-size:15px">カテゴリー</h2>
                <select name="post[prefecture_id]" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                    @foreach($prefecturs as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                    @endforeach
                    <br>
                </select>
                <select name="post[cost_id]" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                    @foreach($costs as $cost)
                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                    @endforeach
                </select>
                
            </div>
                <h2 style="font-size:15px">タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"  style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div>
                <h2 style="font-size:15px">本文</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;min-width: 500px;min-height: 100px;" >{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>

            <input type="submit" value="保存" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;"/>
        </form>
        <div style="margin-left:50px"><a href="/">戻る</a></div>
    </body>
</html>
