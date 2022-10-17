<?php

function dd(...$streams){
    foreach($streams as $streams){
        var_dump($streams) . PHP_EOL;
    }
    die;
}

function getnumberfromstring($string){
    //preg_match_all('!\d+!', $string, $matches);
    return (preg_match('#[0-9]#',$string)) ? true : false;

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