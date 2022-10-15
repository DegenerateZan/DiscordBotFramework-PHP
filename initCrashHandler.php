<?php

require "config.php";

function getnumberfromstring($string){
    //preg_match_all('!\d+!', $string, $matches);
    return (preg_match('#[0-9]#',$string)) ? true : false;

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

function getsystemlog(){
   
    $json = fread(fopen("cache/system.crash.jsonc", "r"), 80000);
    $log = fread(fopen("cache/system.crash.log", "r"), 200000);

    $fail = array(false, NULL, NULL); // nilai gagal
    
    // $pid = fread(fopen("cache/pidbot.txt", 'r'),1000);
    // if(!$pid) return $fail;
    //jika process mati 
    //if(!getnumberfromstring(exec("pid -p $pid"))) return $fail;
    /*else*/ return array(true, $json, $log);
    
}

require 'CrashHandler/Handler.php';
require 'CrashHandler/MessageHandler.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use React\EventLoop\Loop;

echo "Initializing PHP bot Framework Crash Handler Assistance Version 1.0\n";

$discord = new Discord([
    'token' => getkey(),
    'loop' => Loop::get()
]);
$con = true;
$discord;
$discord->on('ready', function (Discord $discord){
    echo "Crash Handler Siap Digunakan";
        $loop = $discord->getLoop();
        global $discord;
        $discord = $discord; 

        global $con;
        
        while ($con){
            $con = false;
            if (getsystemlog()[0] === NULL) goto skip;
            $get = getsystemlog();
            $json = $get[1]; $log = $get[2];
            $handler = new Handler($discord, $json, $log);
            // ob_start();
            // var_dump($handler);
            // $dump = ob_flush();
            // file_put_contents("log.txt", $dump);
            
            skip:
            sleep(10);
            $con = true;

        };


        
        
    
});

$discord->run();




