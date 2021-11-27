{{-- @extends('layout') --}}

{{-- @section('banner')
    <h1 style="text-align: center">my blog</h1>
@endsection --}}

{{-- @section('content')
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
@endsection --}}


<x-layout>

    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
               <x-posts-grid :posts="$posts" />
               {{-- pagination links --}}
               {{ $posts->links() }}
        @else
            <p class= "text-center">No posts yet</p>
        @endif    

        {{-- <div class="lg:grid lg:grid-cols-2">
            
            <x-post-card />
            <x-post-card />
            
        </div>

        <div class="lg:grid lg:grid-cols-3">
            <x-post-card />
            <x-post-card />
            <x-post-card />
        </div> --}}
    </main>


</x-layout>  

