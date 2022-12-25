<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;


function message_event(Discord $discord){
    $discord->on('message', function(Message $message){
        global $maincontroller;
        $content = $message-> content;
        $condition = strpos($content, $maincontroller->prefix);
        if ($condition != 0 || $condition === false) return;

        
        
        
        echo "\n++++++++++++++++ MESSAGE COMMAND PREFIX DETECTED, EXECUTING COMMAND ++++++++++++++++\n";            

        $content = trim($content, $maincontroller->prefix);
        $maincontroller->initMessCommandController($message, $content);
    });
}