<?php
    use Kami\Skblog\Classes\Posts;
    
    $posts = Posts::getPosts();
    $blog_dir = BLOG_URL;

    foreach ($posts as $index => $post) {
        $postMeta = Posts::get_post_meta($post);

        $postName = rtrim($post, ".md");
        echo "<a href='$blog_dir/$postName'>". $postMeta["name"] ."</a><br>";
    }
?>