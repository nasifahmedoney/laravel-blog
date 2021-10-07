<html>
    <head>
        <title>Blog</title>
        <link rel="stylesheet" href="/app.css">
    </head>
    <body>
        
        <article>
            <h1>{{$post->title}}</h1>
            {!! $post->body !!}    
        </article>
        <a href="/">Go back</a>
    </body>
</html>