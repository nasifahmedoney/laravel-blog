<html>
    <head>
        <title>Blog</title>
        <link rel="stylesheet" href="/app.css">
    </head>
    <body>
        <?php foreach ($posts_var_from_route as $post): ?>
            
        <article>
            <a href="/post/<?= $post->slug; ?>"><h1><?= $post->title; ?></h1></a>
            <p><?= $post->body; ?></p>
        </article>
        <?php endforeach; ?>
    </body>
</html>

