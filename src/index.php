<?php
require_once("../vendor/autoload.php");
require_once("../config.php");

use \Kami\Skblog\Classes\Blog_renderer;
use Kami\Skblog\Classes\Views;

$request = $_SERVER['REQUEST_URI'];

if($path[0] === "") {
    unset($path[0]);
}

render($request);


function render($request) {
    $builtPathCurrent = "";
    $builtPathCurrent = VIEW_URL . $request;

    if($request === "/") {
        Views::require_view("/server/index.php");
        return;
    }

    $path = explode("/", $request);
    if($path[1] === BLOG_URL) {
        Blog_renderer::render_blog($path);
        return;
    }

    if(file_exists("$builtPathCurrent.phtml")) {
        require_once("$builtPathCurrent.phtml");
    }

    Views::require_view($path[array_key_last($path)]);
}

