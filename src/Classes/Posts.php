<?php

namespace Kami\Skblog\Classes;

class Posts {
    public static function getPosts() {
        $path = CONTENT_DIR;
        return array_diff(scandir($path), array('.', '..'));
    }

    public static function get_post_meta($postfile) {
        $post_path = CONTENT_DIR . "/$postfile";
        $post_content = file_get_contents($post_path);
        $parser = Markdown::get_md_parser();

        $frontMatterExtension = Markdown::get_frontmatter();
        $result = $frontMatterExtension->getFrontMatterParser()->parse($post_content);

        return $result->getFrontMatter();
    }

}