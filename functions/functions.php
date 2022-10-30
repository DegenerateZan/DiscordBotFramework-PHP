<?php

function dd(...$vars){
    var_dump($vars) . PHP_EOL;
    die;
}

function getnumberfromstring($string){
    //preg_match_all('!\d+!', $string, $matches);
    return (preg_match('#[0-9]#',$string)) ? true : false;

}

function cutselected($string,$selected) {
    $selected_length = strlen($selected);
    $max_length = strlen($string);
    $firstoffset = strpos($string, $selected) + $selected_length;
    $hasil=substr($string, $firstoffset);
    return $hasil;
    
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function exception_and_die($exception){
    throw new Exception($exception);
    die;
} 

function var_dumps_new_lines(...$stream){
    $i = 1;
    foreach($stream as $a){

        echo "Debug Variable Dump number $i\n";
        var_dump($stream);
        $i++;
    }
}

function newlines($string){
    echo str_repeat("\n", 5);
    echo "========== EXECUTING $string ==========";
    echo str_repeat("\n", 5);
}

function truncate(){
    fwrite(fopen("cache/system.crash.jsonc","w")," ");
    //fwrite(fopen("cache/system.crash.log","w")," ");

    fwrite(fopen("cache/pidbot.txt","w")," ");

}

function truncate_log(){
    fwrite(fopen("cache/system.crash.log","w")," ");
}