<?php

namespace Utils;

class UriParser
{
    static public function parseUri(){
        $uri = trim($_SERVER['REQUEST_URI'], "/");
        $path = explode("/", $uri);
        return array_splice($path, 1);
    }
}