@extends('layouts.default')
@section('content')
    <article>
        <div class="row">
            {{--            @foreach($post as $article)--}}
            {{--                <h3>{{$article->title}}</h3>--}}
            {{--                <p>Published on {{$article->created_at}}</p>--}}
            {{--                <p2>{{$article->content}}</p2>--}}
            {{--            @endforeach--}}
            <h2>{{$post['0']->title}}</h2>
            <p>Published on {{$post['0']->created_at}}</p>
            <p>{{$post['0']->content}}</p>
        </div>
        <a href="/">Вернуться на главную</a>
    </article>
@stop
