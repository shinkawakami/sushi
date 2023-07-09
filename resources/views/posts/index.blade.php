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
        <form class="search" style="margin:50px 50px 10px;">
            @csrf
        <select name="prefecture" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc width:50px;">
            <option value="">旅行先</option>
            @foreach ($prefectures as $prefecture)

                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
            @endforeach
        </select>
        <select name="costs" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc width:50px;">
            <option value="">予算</option>

            @foreach ($costs as $cost)
                <option value="{{ $cost->id }}">{{ $cost->cost }}</option>
            @endforeach
        </select>
        <input type="submit" value="検索" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;"/>

        <h1 style="margin:50px 50px 10px;font-size:30px;font-weight: bold;">旅ログ</h1>
        <h2 style="margin:50px 50px 10px;font-size:20px;font-weight: bold;">投稿一覧画面</h2>
        
        <div class="container">
        @foreach($posts as $post)
            <div class="postcontent">
                <div>
                <img src="{{ $post->image_url }} " alt="画像が読み込めません。"/>
                </div>
                <h2　class="title" style="margin-bottom:5px;"><a href="/posts/{{ $post->id }}">{{$post->title}}</a></h2>
                <p>{{$post->body}}</p><br>
                
                <div class="user">
                <a href="/myPosts" style="display: inline-block;">投稿者：{{ $post->user->name }}</a>
                </div>
                @if(Auth::check() && $post->user_id == Auth::user()->id)
                    <div class="delete">
                        <form id="delete-{{ $post->id }}" action="/posts/{{ $post->id }}" method="POST";>            
                        @csrf
                        @method('DELETE')
                            <x-secondary-button onclick="if(confirm('本当に削除しますか？')) {
                            event.preventDefault(); document.getElementById('delete-{{ $post->id }}').submit(); 
                            }">削除</x-secondary-button>
                        </form>
                    </div>
                    @endif
            </div>
        @endforeach
        </div>
        <div style="margin-left:50px"><a href="/">トップ画面にもどる</a></div>
        <div>
        
        </div>
    </x-app-layout>
</html>