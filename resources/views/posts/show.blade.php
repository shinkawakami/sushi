<!DOCTYPE HTML>  
      <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Posts</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            </x-slot>
                 <h1 style="margin:50px 150px 10px;font-size:30px;font-weight: bold;">詳細画面</h1>
            <div style="display: inline-block;border: 5px double #aaa;padding: 2em;margin-left:100px">
            <div>
                <p style="margin-top:10px;font-weight: bold;">  行った場所：{{ $post->title }}</p>
                <p style="margin-top:10px;font-weight: bold;">旅行内容：{{ $post->body }}</p>
                <img src="{{ $post->image_url }}" style="width:30%;height:30%;margin-top:30px;" alt="画像が読み込めません。"/>
                @foreach ($post->comments as $comment)
                    <p>コメント：{{ $comment->body }}</p>
                @endforeach
            </div>
            <div>
                <form action="/posts/{{$post->id}}" method="POST" >
                    @csrf
                    <label for="post-comment" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;min-width: 500px;min-height: 100px;">コメント</label>
                    <input type="text" name="post_comment" required maxlength="20" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;min-width: 500px;min-height: 50px;">
                    <input type="submit" value="保存" style="cursor: pointer;margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;margin-top:50px;box-shadow: 0 0 0 #bbb;background-color: 333;transition: .3s;">
                </form>
            </div>
            <div>
                <p class="edit" style="cursor: pointer;margin-top:50px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;"><a href="/posts/{{ $post->id }}/edit">編集</a></p>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" onclick="deletePost({{ $post->id }})" style="cursor: pointer;margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;">削除</button> 
</form>
                <div><a href="/" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;padding: 8px 15px;text-decoration: none;border-radius: 5px;">戻る</a></div>
            </div>
            </div>
            
            <script>
    function deletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
    </x-app-layout>
</html>
