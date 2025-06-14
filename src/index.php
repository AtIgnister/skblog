<?php
require_once("../vendor/autoload.php");
require_once("../config.php");

use \Kami\Skblog\Classes\Blog_renderer;

$request = $_SERVER['REQUEST_URI'];

if($path[0] === "") {
    unset($path[0]);
}

render($request);


function render($request) {
    $builtPathCurrent = "";
    $builtPathCurrent = VIEW_URL . $request;

    $path = explode("/", $request);
    if($path[1] === BLOG_URL) {
        Blog_renderer::render_blog($path);
        return;
    }


    if(!file_exists("$builtPathCurrent.phtml")) {
        require_once(PAGE_404);
    }
    require_once("$builtPathCurrent.phtml");
}

