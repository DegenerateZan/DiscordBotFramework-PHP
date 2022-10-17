<?php

 class Evaluate{
    public  $type = "External",
            $privilege = "owner",
            $permitted_cmd_type = "message";
    private $discord,
            $message;
    

    public function __construct($discord, $message, $content){
        $this->discord = $discord;
        $this->message = $message;

      
        
    }
    public function go(){
        eval($this->message->content);
    }

}