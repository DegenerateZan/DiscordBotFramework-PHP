<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;

    /**
    *a standalone send message
    */
class MiniMessHandler{

    /**
    *a standalone send message to a channel of a message
    */
    public static function sendMess(Message $message, $message_content){
        if(strlen($message_content) < 1) return;
        $message->channel->sendMessage($message_content);
    }
    public static function sendMessWithCountDown(Message $message, $message_content, $time, Discord $discord){
        
        $message->channel->sendMessage($message_content)->done( function (Message $message) use ($discord, $time){
            $loop = $discord->getLoop();
            $loop->addTimer( (int)$time, function () use ($message){
                $message->delete();
            });
        });
    }
}