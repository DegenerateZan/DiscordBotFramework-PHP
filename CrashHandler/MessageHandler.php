<?php


use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\Builders\MessageBuilder;
require "CrashHandler/Parts/MessageHandlerPart.php";


class MessageHandler extends MessageHandlerPart{
    public $message, //message object
            $discord, //discord object
            $data, // log object
            $log, // log details
            $user;    //user object

    public function __construct($discord,$channel, $message, $data, $user, $log){
    newlines("CONSTRUCTOR");


    $this->message = $message;
    $this->discord = $discord;
    $this->channel = $channel;
    $this->data = $data;
    $this->user = $user;
    $this->log = $log;
    self::reason();
    self::embedWarning();
    self::messbuilder();
    self::sendwarning();


    }


    public function sendwarning(){
        $this->message->reply($this->message_builder)->done(function (){
            global $con;
            $con = true;
        });
    }
}