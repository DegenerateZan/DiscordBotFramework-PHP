<?php

use Discord\Builders\MessageBuilder;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;

/**
 * a Command controller for Discord message based type Command
 */
class MessageCommandController {
    private $discord,
            $message,
            $core,
            $object,
            $content, // raw content
            $content_pieces; // exploded content
    public  $destroy = false;


    public function __construct($discord, $message, $content, $core){
        $this->discord = $discord;
        $this->message = $message;
        $this->content = $content;
        $this->core = $core;
        $this->content_pieces = explode(" ",$content); // but instead i used this to specify the which method of a class to invoke
        self::validation();
        
    }

    private function runCustomMethod(){

        if(!method_exists($this->object, $this->content_pieces[1])) $this->object->init(); // to call the default method if the method to invoke its not specified
        if (method_exists($this->object, $this->content_pieces[1]))call_user_func(array($this->object, $this->content_pieces[1]));  //the opposite, if its default method and specified also doesn't exist, destroy the Message Controller Instance
        else $this->destroy = true;

    }

    private function validation(){
        $content = $this->content;
        $discord = $this->discord;
        $message = $this->message;
        $core    = $this->core;
        $class = ucfirst($this->content_pieces[0]);
        if(!class_exists($class)){ $this->destroy = true; return;}

        $object = (object) new $class($discord, $message, $content, $core);
    
        if(!is_subclass_of($object, 'MessageCommand')){ $this->destroy = true; return;}

        new Logger($object->type, $message);
        $result = self::checkPrivilege($object);
        $this->object = $object;

        if(!$result[0]){ MiniMessHandler::sendMess($message,"Sorry, " . $message->author . " " . $result[1]);
        $this->destroy = true;
        return;}
            
        
        self::runCustomMethod();
   
    }

    private function checkPrivilege($object){
        $stream = file_get_contents(MAINBOT."Config/privilege.json");

        $ids = json_decode($stream);
        $ids = $ids->specials;
        $pass = array(true, "");
        switch ($object->privilege) {
            case 'public':
                $result = $pass;
                break;

            case 'specials':
                
                if (in_array($this->message->author->id, $ids)) $result = $pass;
                else $result = array(false, "This command can only be executed by Permitted users");
                
                if (OWNER == $this->message->author->id) $result = $pass;
                
                break;  
            case 'owner':

                if (OWNER == $this->message->author->id) $result = $pass;
                else $result = array(false, "This command can only be executed by Owner of the Bot");
                break;
            
            default:

                $result = array(false, "the Selected Command doesn't have specified privilege!, Aborting Process");
                break;
        }
        return $result;
    }

    


}