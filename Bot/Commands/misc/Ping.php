<?php



 class Ping extends MessageCommand {
    public  $type = "Internal",
            $privilege = "public";

    public function init(){
        $this->message->reply("pong");
    }

}