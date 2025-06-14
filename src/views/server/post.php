<?php
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;

$parser = POST_PARSER;
$content = POST_CONTENT;

$compiled = $parser->convert($content);

// Grab the front matter:
if ($compiled instanceof RenderedContentWithFrontMatter) {
    $frontMatter = $compiled->getFrontMatter();
    echo $frontMatter["name"];
}

echo $compiled;