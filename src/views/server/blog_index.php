<?php
    use Kami\Skblog\Classes\Blog_renderer;
    function getPosts() {
        $path = CONTENT_DIR;
        return array_diff(scandir($path), array('.', '..'));
    }
    
    $posts = getPosts();
    $blog_dir = BLOG_URL;

    foreach ($posts as $index => $post) {
        $postMeta = Blog_renderer::get_post_meta($post);

        $postName = rtrim($post, ".md");
        echo "<a href='$blog_dir/$postName'>". $postMeta["name"] ."</a>";
    }
?>