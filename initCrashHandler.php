<?php

require "config.php";


function getsystemlog(){
   
    $json = fread(fopen("cache/system.crash.jsonc", "r"), 80000);
    $log = fread(fopen("cache/system.crash.log", "r"), 200000);

    $fail = array(false, NULL, NULL); // nilai gagal
    
    $pid = (int) fread(fopen("cache/pidbot.txt", 'r'),1000);

    if(!$pid or $log === null) return $fail;
    $pid = $pid - 1;
    //jika process mati 
    $output = exec("ps -p $pid");
    
    // if(getnumberfromstring($output)) echo "\nNUMBER FOUND\n";
    // else echo "\nNUMBER NOT FOUND\n";
  
    if(getnumberfromstring($output)) return $fail; // if the process found return fail and skip the send Message Procedure
    else{ 
        if($json === null) die("Main Bot Process has died!\nBut cannot get the last message Command detail\nThis Died Process can be caused by the Framework Exception or incorrectly Custom Command coding structure doesn't follow framework structure rules! ");
        return array(true, $json, $log);
    }
    
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

$discord->on('ready', function (Discord $discord){
    echo "Crash Handler Siap Digunakan";
        
        $discord->loop;
        $discord->on('message', function(Message $message) {
            if ($message->author->id == OWNER and $message->content == "System::kernel->restart(MAINBOT)"){
                $log = getsystemlog();
                if ($log[0]){
                    $message->react("❌");
                    $message->reply("Main Bot Instance is still running!")->done(function(Message $m){
                        sleep(2);
                        $m->delete();
                    });
                } else {
                    $o =exec("bash scripts/start_init.sh");
                    echo $o . PHP_EOL;
                    $message->react("✅");

                }
            }
        });
        
        $loop = $discord->getLoop();
        $loop->addPeriodicTimer(3,function () use ($discord) {
            exec("rm -rf cache/temp/*.*");
            $log = getsystemlog();
         
            if ($log[0] === FALSE) goto skip;
            
            $json = $log[1]; $log = $log[2];
            $handler = new Handler($discord, $json, $log);
            truncate();
            truncate_log();
            skip:
            
            

       
    });
    
});


$discord->run();




