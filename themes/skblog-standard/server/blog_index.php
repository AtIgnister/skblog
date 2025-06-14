<?php

use Kami\Skblog\Classes\Posts;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style.css" rel="preload">
</head>

<body>
    <header>
        <a class="title" href="/">
            <h1>
                Kami's Corner
            </h1>
        </a>
        <nav>
            <p><a href="/">Home</a> <a href="/blog/">Blog</a></p>
        </nav>
    </header>
    <main>
        <ul class="blog-posts">
            <?php
                $posts = Posts::getPosts();
                $blog_dir = BLOG_URL;

                foreach ($posts as $index => $post) {
                    $postMeta = Posts::get_post_meta($post);

                    $postName = rtrim($post, ".md");
                    echo "
                    <li>
                        <a href='/$blog_dir/$postName'>" . $postMeta["name"] . "</a><br>
                    </li>
                    ";
                }
            ?>
        </ul>

        <span>
            Powered by skBlog</a>
        </span>

        </footer>


</body>

</html>