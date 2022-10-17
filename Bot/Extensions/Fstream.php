<?php

class Fstream{

    public static function Fread($location ){
        return file_get_contents($location);
    }
    public static function Fwrite($location, $content){

        $stream = fopen($location, 'w') or die("Cannot Open File!, of the Location : $location");
        
        $result = fwrite($stream, $content);
        if ($result === false) die("Cannot Write");
    }
}

