<?php

namespace Kami\Skblog\Classes;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class Blog_renderer {
    public static function render_blog($path) {
        if(self::is_blog_index($path)) {
            require_once(VIEW_URL . "/server/blog_index.php");
            return;
        }

        $post_path = "../content/" . $path[2] . ".md";

        if(file_exists($post_path)) {
            self::render_post($path);
        } else {
            require_once(PAGE_404);
        }
    }

    public static function render_post($path) {

        if(!isset($path[1])) {
            require_once(PAGE_404);
        }

        $post = $path[2];
        $post_path = CONTENT_DIR . "/$post.md";

        $post_content = file_get_contents($post_path);

        $parser = self::get_md_parser();

        define("POST_CONTENT", $post_content);
        define("POST_NAME", $post);
        define("POST_PARSER", $parser);

        require_once(VIEW_URL . "/server/post.php");
    }

    public static function get_post_meta($postfile) {
        $post_path = CONTENT_DIR . "/$postfile";
        $post_content = file_get_contents($post_path);
        $parser = self::get_md_parser();

        $frontMatterExtension = new FrontMatterExtension();
        $result = $frontMatterExtension->getFrontMatterParser()->parse($post_content);

        return $result->getFrontMatter();
    }

    private static function get_md_parser() {
        // Define your configuration, if needed
        $config = [];

        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add the extension
        $environment->addExtension(new FrontMatterExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);

        return $converter;
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