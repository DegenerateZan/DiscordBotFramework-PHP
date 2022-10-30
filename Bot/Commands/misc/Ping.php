<?php
 class Ping{
    public  $type = "Internal",
            $privilege = "public",
            $permitted_cmd_type = "message";
    private $discord,
            $message;
    

    public function __construct($discord, $message){
        $this->discord = $discord;
        $this->message = $message;
        
    }
    public function init(){
        $this->message->reply("pong");
    }

}