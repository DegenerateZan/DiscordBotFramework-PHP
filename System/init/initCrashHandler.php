<?php
chdir(dirname(dirname(__DIR__)));


require "System/core/config.php";
require ROOT."CrashHandler/LoadSystemLog.php";

$systemlog = new LoadSystemLog;

global $systemlog;

require 'CrashHandler/Handler.php';
require 'CrashHandler/MessageHandler.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use React\EventLoop\Loop;

echo "Initializing PHP bot Framework Crash Handler Assistance Version ".CRASH_HANDLER_VERSION.PHP_EOL;

$discord = new Discord([
    'token' => getkey(),
    'loop' => Loop::get()
]);

$discord->on('ready', function (Discord $discord){
    echo "Crash Handler Siap Digunakan";
    
    global $systemlog;


        $discord->loop;
        $discord->on('message', function(Message $message) {
            if ($message->author->id == OWNER and $message->content == "System::kernel->restart(MAINBOT)"){
                global $systemlog;
                
                if (!$systemlog->checkShell()){
                    $message->react("❌");
                    $message->reply("Main Bot Instance is still running!")->done(function(Message $m){
                        sleep(2);
                        $m->delete();
                    });
                } else {
                    $o =exec("php init.php & > /dev/null & echo $! >cache/pidbot.txt");
                    echo $o . PHP_EOL;
                    $message->react("✅");

                }
            }
        });
        
        $loop = $discord->getLoop();
        $loop->addPeriodicTimer(3,function () use ($discord, $systemlog) {
         
            if ($systemlog->checkShell() === FALSE) goto skip;
            
            $json = $systemlog->getLog()[0]; $log = $systemlog->getLog()[1];
            $handler = new Handler($discord, $json, $log);
            truncate();
            truncate_log();
            unset($handler);
            skip:
            
            

       
    });
    
});


$discord->run();




