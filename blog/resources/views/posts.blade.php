@extends('layout')

{{-- @section('banner')
    <h1 style="text-align: center">my blog</h1>
@endsection --}}

@section('content')
    @foreach ($posts as $post)
    <article>
        <a href="/post/{{$post->slug}}"><h1>{{$post->title}}</h1></a>
        <p>
            By <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a> in
            <a href="/categories/{{$post->category->slug}}">{{$post->category->name}} </a>
        </p>
        <p>{!! $post->excerpt !!}</p> <!-- !! for fetching html content --> 

    </article>
    @endforeach
@endsection
    
  

