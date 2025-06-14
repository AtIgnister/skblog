<?php

namespace Kami\Skblog\Classes;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\MarkdownConverter;

class Markdown {
    public static function get_md_parser() {
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

    public static function get_frontmatter() {
        $frontMatterExtension = new FrontMatterExtension();
        return $frontMatterExtension;
    }
}