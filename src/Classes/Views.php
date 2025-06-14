<?php 

namespace Kami\Skblog\Classes;

class Views {
    private static $mime_type_array = [
        "js" => "text/javascript",
        "css" => "text/css",
        "json" => "application/json",
        "mp3" => "audio/mpeg",
        "mp4" => "video/mp4"
    ];


    private static function outputMimeType($ext) {
        if(key_exists($ext, self::$mime_type_array)) {
            header('Content-type: ' . self::$mime_type_array[$ext]);
        } else {
            header('Content-type: text/html');
        }
    }


    public static function require_view($path) {
        $theme_dir = THEME_DIR;
        $theme = THEME;
        $view_path = BASE . "/src/" . VIEW_URL;

        $view_path_theme = "$theme_dir/$theme/$path";
        $view_path_default = "$view_path/$path";
        
        if(file_exists($view_path_theme)) {
            $ext = pathinfo($view_path_theme, PATHINFO_EXTENSION);
            self::outputMimeType($ext);
            require_once($view_path_theme);
            return;
        }

        if(file_exists($view_path_default)) {
            $ext = pathinfo($view_path_default, PATHINFO_EXTENSION);
            self::outputMimeType($ext);
            require_once($view_path_default);
            return;
        }

        require_once("$view_path/server/404.php");
    }
}