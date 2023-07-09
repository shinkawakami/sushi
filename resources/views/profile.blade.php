<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <title>Blog</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            <!-- Scripts -->
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
            <!-- Styles -->　
            <link href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
            <style>
                .flex-container {
                    display: flex;
                    justify-content: space-between;
                    padding: 0 5%;
                }
                .content-box {
                    width: 60%;
                    word-wrap: break-word;
                }
                #calendar {
                    width: 30%; 
                    height: 150px;
                    margin-left: 5%;
                }
                .post-image {
                    width: 100%; 
                    max-width: 300px; 
                    height: auto;
                }
            </style>
        </x-slot>
        <div class="flex-container">
            <div class="content-box">
                <h2 style="margin:50px 0 10px;font-size:30px;font-weight: bold;">プロフィール</h2>
                <h2 style="margin:30px 0 10px;font-size:20px;font-weight: bold;">ユーザーネーム：{{ $user->name }}</h2>
                <form action="/myPosts" method="POST" style="margin:30px 0 10px">
                    @csrf
                    @method('PUT')
                    <h2 style="font-size:15px;font-weight: bold;">自己紹介</h2>
                    <textarea name="user_introduction" rows="4" cols="50" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">{{ old('user_introduction', $user->content) }}</textarea>
                    <input type="submit" value="保存" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;">
                </form>
                
                @foreach ($posts as $post)
                    <a href="/posts/{{ $post->id }}" class="post-link">
                        <div class="post" style="border: 5px double #aaa;padding: 2em;margin-top:20px">
                            <h2 style="font-size:15px;font-weight: bold;">[旅行先]：<span class="post-detail">{{ $post->prefecture->name }}</span></h2>
                            <h2 style="font-size:15px;font-weight: bold;">[予算]：<span class="post-detail">{{ $post->cost->cost }}</span></h2>
                            <h2 style="font-size:15px;font-weight: bold;">[行った場所]：<span class="post-detail">{{ $post->title }}</span></h2>
                            <h2 style="font-size:15px;font-weight: bold;">[旅行内容]</h2>
                            <p class="post-detail" style="font-size:15px;">{{ $post->body }}</p>
                            <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="post-image"/>
                            
                            <form action="/posts/{{ $post->id }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="削除" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;">
                            </form>
                        </div>
                    </a>
                @endforeach
            </div>
            <div id='calendar'></div>
        </div>
        
        <script>
            $(document).ready(function() {
                var events = {!! json_encode($posts->map(function ($post) {
                    return [
                        'title' => $post->title,
                        'start' => $post->date,
                        'url' => '/myPosts/' . $post->date
                    ];
                })) !!};

                $('#calendar').fullCalendar({
                    events: events,
                    eventClick: function(event) {
                        if (event.url) {
                            window.location.href = event.url;
                            return false;
                        }
                    }
                });
            });
        </script>
    </x-app-layout>
</html>
