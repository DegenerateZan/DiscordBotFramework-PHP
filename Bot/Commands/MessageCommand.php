<?php


    use Discord\Discord;
    use Discord\Parts\Channel\Message;
    






/**
 * this class is responsible to inherite the default method & properties of
 * message command model tipe 
 */
abstract class MessageCommand {
    public      $permitted_cmd_type = "message";
    protected   $discord,
                $message,
                $content,
                $core;
    

    public function __construct(Discord $discord, Message $message, $content, $core){
        $this->discord = $discord;
        $this->message = $message;
        $this->content = $content;
        $this->core    = $core;


        

    
    }



}


