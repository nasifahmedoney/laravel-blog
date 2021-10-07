<html>
    <head>
        <title>Blog</title>
        <link rel="stylesheet" href="/app.css">
    </head>
    <body>
        @foreach ($posts_var_from_route as $post)
        <article>
            <a href="/post/{{$post->slug}}"><h1>{{$post->title}}</h1></a>
            <p>{!! $post->body !!}</p> <!-- !! for fetching html content --> 
        </article>
        @endforeach
    </body>
</html>

