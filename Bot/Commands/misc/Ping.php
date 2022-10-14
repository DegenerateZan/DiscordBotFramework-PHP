<?php
 class Ping{
    public  $type = "Internal",
            $privilege = "public";
    private $discord,
            $message;
    

    public function __construct($discord, $message, $content){
        $this->discord = $discord;
        $this->message = $message;
        
    }
    public function init(){
        $this->message->reply("pong");
    }

}