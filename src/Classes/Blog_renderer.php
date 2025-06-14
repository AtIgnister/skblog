<?php

namespace Kami\Skblog\Classes;
use Kami\Skblog\Classes\Markdown;

class Blog_renderer {
    public static function render_blog($path) {
        if(self::is_blog_index($path)) {
            Views::require_view("/server/blog_index.php");
            return;
        }

        $post_path = "../content/" . $path[2] . ".md";

        if(file_exists($post_path)) {
            self::render_post($path);
        } else {
            Views::require_view("server/404.php");
        }
    }

    public static function render_post($path) {

        if(!isset($path[1])) {
            Views::require_view("server/404.php");
        }

        $post = $path[2];
        $post_path = CONTENT_DIR . "/$post.md";

        $post_content = file_get_contents($post_path);

        $parser = Markdown::get_md_parser();

        define("POST_CONTENT", $post_content);
        define("POST_NAME", $post);
        define("POST_PARSER", $parser);

        Views::require_view("/server/post.php");
    }


    private static function is_blog_index($path) {
        if(!isset($path[1])) {
            return false;
        }

        if($path[1] !== "blog") {
            return false;
        }

        if(isset($path[2])) {
            if($path[2] === "") {
                return true;
            }

            return false;
        }

        return true;
    }
}