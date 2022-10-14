<?php


require MAINBOT."Commands/misc/Ping.php";
require MAINBOT."Commands/misc/Speedtest.php";
use Discord\Parts\Channel\Message;

class CommandController {
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
        $this->content_pieces = explode(" ",$content);
        self::validation();

    }

    private function runCustomMethod(){
        if(!array_key_exists(1,$this->content_pieces)) $this->content_pieces[1] = "";

        if(!method_exists($this->object, $this->content_pieces[1])) $this->object->init();
        if (method_exists($this->object, $this->content_pieces[1]))call_user_func(array($this->object, $this->content_pieces[1]));  //check if the method instance
        
        else $this->destroy = true;
           
    }

    private function validation(){
        $content = $this->content;
        $discord = $this->discord;
        $message = $this->message;
        $class = ucfirst($this->content_pieces[0]);

        if(!class_exists($class)){ $this->destroy = true; return;}

        $object = (object) new $class($discord, $message, $content);
    
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
        switch ($object->privilege) {
            case 'public':
                $result = array(true, "");
                break;

            case 'specials':
                foreach ($ids as $id) {
                    if ($id == $this->message->author->id) $result = array(true, "");
                    else $result = array(false, "This command can only be executed by Permitted users");
                }
                if (OWNER == $this->message->author->id) $result = array(true, "");
                
                break;  
            case 'owner':

                    if (OWNER == $this->message->author->id) $result = array(true, "");
                    else $result = array(false, "This command can only be executed by Owner of the Bot");
                    break;

        }
        return $result;
    }

    


}