<?php


require MAINBOT."Commands/misc/Ping.php";
require MAINBOT."Commands/misc/Eval.php";
require MAINBOT."Commands/System/addSlashCommand.php";
use Discord\Parts\Channel\Message;

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
        $this->content_pieces = explode(" ",$content); // but instead u used this just in case another type of command need it
        //$this->class = strtok($content); // it'll only get the first elememnt
        self::validation();
        
    }

    private function runCustomMethod(){
        if(!array_key_exists(1,$this->content_pieces)) $this->content_pieces[1] = ""; // to prevent the error of an undefined array key

        if(!method_exists($this->object, $this->content_pieces[1])) $this->object->init();
        if (method_exists($this->object, $this->content_pieces[1]))call_user_func(array($this->object, $this->content_pieces[1]));  //check if the method instance
        
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