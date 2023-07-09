<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <meta charset="utf-8">
            <title>Blog</title>
        </x-slot>
        <h1></h1>
        <h2 style="margin:50px 150px 10px;font-size:30px;font-weight: bold;">投稿作成</h2>
        <form action="/posts" method="POST" enctype="multipart/form-data" style="display: inline-block;border: 5px double #aaa;padding: 2em;margin-left:100px">
            @csrf
            <div>
                <div>
                <h2 style="font-size:15px;font-weight: bold;">カテゴリー</h2>

                <select name="post[prefecture_id]"  style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                <option value="">旅行先を選択してください</option>
                @foreach ($prefectures as $prefecture)

                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                @endforeach
                </select>
                <select name="post[cost_id]"  style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                <option value="">予算を選択してください</option>

                    @foreach ($costs as $cost)
                <option value="{{ $cost->id }}">{{ $cost->cost }}</option>
                @endforeach
                </select>
                </div>
                <h2 style="font-size:15px;font-weight: bold;margin-top:10px;">行った場所</h2>
                <input type="text" name="post[title]" placeholder="場所を教えてください" value="{{ old('post.title') }}"  style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                <div>
                <h2 style="font-size:15px;font-weight: bold;margin-top:10px;">旅行内容</h2>
                <textarea name="post[body]" placeholder="旅行の内容を教えてください" style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;min-width: 500px;min-height: 100px;" >{{ old('post.body') }}</textarea>

                <div style="border-radius: 5px;padding: 10px; solid #ccc;">

                </div>
                <div>

                    <label for="post_date" style="font-weight: bold;">日付</label>
                    <input type="date" id="post_date" name="post[date]" required  style="border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>

            </div>
            <div class="image" style="margin-top:10px;border-radius: 5px;padding: 10px;border: 1px solid #ccc;">
                <input type="file" name="image" >
            </div>

            <input type="submit" value="保存" style="margin-top:10px;display: inline-block;color: #fff;font-weight: bold;background-color: #333;text-align: center;padding: 8px 15px;text-decoration: none;border-radius: 5px;cursor: pointer;box-shadow: 0 0 0 #bbb;background-color: 333;transition: .3s;">
            <div style=" display: inline-block;color: #fff;font-weight: bold;background-color: #333;padding: 8px 15px;text-decoration: none;border-radius: 5px;"><a href="/">戻る</a></div>
        </div>    

        </form>
    </x-app-layout>
</html>
