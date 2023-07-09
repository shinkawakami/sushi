<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <title>Blog</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"><!-- Scripts -->
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
            <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
        
            <!-- Styles -->
            <link href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
        </x-slot>
            <h1>プロフィール</h1>
            <div>
                <p>ユーザーネーム：{{ $user->name }}</p>
                <form action="/myPosts" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="user-intoduction">自己紹介</label>
                    <input type="text" name="user_introduction" required maxlength="100" value="{{ $user->content }}">
                    <input type="submit" value="保存">
                </form>
                
                @foreach ($posts as $post)
                    <div style='border:solid 1px; margin-bottom: 10px;'>
                        <p>
                            タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </p>
                        <p>本文：{{ $post->body }}</p>
                    </div>
                @endforeach
                
                <div id='calendar' style='width: 30%; height: 150px;'></div>
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
                                    window.open(event.url, "_blank");
                                    return false;
                                }
                            }
                        });
                    });
                </script>
                
                
                
            </div>
    </x-app-layout>
</html>
