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
        //self::getmessage();
        self::getuserbyid();
        //self::getuser();
        //self::initMessage(); Commented!, i should wait the user's object promise to be finished

    }
    /**
     * fetch the server's object
     *Warning! : required server_id
     */
    // 
    private function getguild()
    {
        $this->guild = $this->discord->guilds->get('id', $this->data->guild_id);
        
    }
    /**
     * fetch the channel object,
     * Warning! : required channel_id
     */
    // 
    private function getchannel(){
        $this->channel = $this->discord->getChannel($this->data->channel_id);
        
        

    }

        /**
     * 
     * fetch the requester's (user) object using an guild object
     * @return $this
     */
    //
    public function getuserbyid(){
        $discord = $this->discord;
        //$discord->guilds->get('id', $this->data->guild_id)
            $this->guild->members->fetch($this->data->requested_by)->then( function (Member $Member){
                $this->requsted_user = $Member;
                self::initMessage();
            });
    }

            /**
     * 
     * fetch the message by id using an channel object
     * WARNING THIS FUNCTION IS BROKEN ON LATEST DISCORD PHP Causing an infinite loop of queeing
     * , Warning : Required an $message object!
     */
    //
    private function getmessage(){  
        echo PHP_EOL. "initialize get message".PHP_EOL;
        $this->channel->messages->fetch($this->data->message_id)->done(function(Message $message){
            $this->message = $message;
            dd($message);
            self::getuser();
        });
    }

    /** 
    *fetch the requester's (user) object from an message object's properties
    * @return $this
    */
    public function getuser(){
        $this->requsted_user = $this->message->author;
        self::validateObjects();
        
    }

    public function initMessage(){
       $this->message_handler = new MessageHandler($this->discord, $this->channel, $this->message, $this->data, $this->requsted_user, $this->log);
    }

    public function validateObjects(){
        $arr = [$this->discord, $this->data,
        $this->guild,
        $this->channel,
        //$this->message,
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