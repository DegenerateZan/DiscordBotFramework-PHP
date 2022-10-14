<?php

use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\User\Member;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;
require "CrashHandler/Parts/HandlerPart.php";

class Handler extends HandlerPart{

    public      $data, // the data from a json log
                $log;
    protected   $requsted_user, // the user's object
                $channel, // the requester chnanel's object
                $guild, // the guild's object 
                $discord, // the discord's object
                $message,
                $message_handler;

                
    public function __construct(Discord $discord, $data, $log)
    {
        $this->discord = $discord;
        $this->data = $data;
        $this->log = $log;

        self::parse_json();
        self::getguild();
        self::getchannel();
        self::getmessage();
        // self::getuser();
        //self::initMessage();

    }

    // fetch the server's object
    private function getguild()
    {
        $this->guild = $this->discord->guilds->get('id', $this->data->guild_id);
        
    }

    private function getchannel(){
        $this->channel = $this->discord->getChannel($this->data->channel_id);
        

    }

    //fetch the message object from the 
    private function getmessage(){

        $this->channel->messages->fetch($this->data->message_id)->done(function(Message $message){
            $this->message = $message;
            self::getuser();
        });
    }

    // fetch the rezuester's (user) object using the message id
    public function getuser(){
        $this->requsted_user = $this->message->author;
        self::validateObjects();
        self::initMessage();
    }

    public function initMessage(){
       $this->message_handler = new MessageHandler($this->discord, $this->channel, $this->message, $this->data, $this->requsted_user, $this->log);
    }

    public function validateObjects(){
        $arr = [$this->discord, $this->data,
        $this->guild,
        $this->channel,
        $this->message,
        $this->requsted_user];
        $i = 1;
        foreach($arr as $a){
            echo "\n$i\n";
            //var_dump($a);
        
            if ($a === NULL){
                   die;
            }
            $i++;
        }
    }

}