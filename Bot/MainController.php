<?php

require MAINBOT."System/System.php";
require COMMANDS_DIR."MessageCommand.php";
require MAINBOT."Include/include.php";


    //CommandControllers

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\User\Activity;
use Discord\WebSockets\Event;


class MainController {
    private $discord,
            $ins_key = 0,
            $obj_ins, // controller objects
            $core;
    public  $prefix;
                  
            
            
    public function __construct($discord){
            $this->discord = $discord;    
            self::setCore();
            self::setPresence();
            self::loadPrefix();
    }
    private function setCore(){
        $this->core['time'] = (object) new Time();
        $this->core['settings'] = (object) ConfigHandler::loadAndGetConfig();
        $this->core['voiceclient'] = null; 
        if (!isset($this->core['settings']->prefix)) throw new Exception("Cannot Get the default Prefix!\n");
        global $core;
        $core = $this->core;
    }
    private function setPresence(){

        $discord = $this->discord;
        $activity = new Activity($discord, [
            'name' => $this->prefix."help >> if you need me",
            //'name' => "With my master's dick",
            'type' => Activity::TYPE_PLAYING,
        ]);
    
        $discord->updatePresence($activity);
    }

    public function initMessCommandController($message, $content){
        $this->obj_ins[$this->ins_key] = (object) new MessageCommandController( $this->discord, $message, $content, $this->core);
        self::validateDestroyObject();
    }

    public function initSlashCommandController($interaction){
        $this->obj_ins[$this->ins_key] = (object) new SlashCommandController( $this->discord, $interaction, $this->core);
        self::validateDestroyObject();
    }
    private function validateDestroyObject(){
        if($this->obj_ins[$this->ins_key]->destroy) unset($this->obj_ins[$this->ins_key]);
        $this->ins_key++;
    }

    private function loadPrefix(){
        $this->prefix = $this->core['settings']->prefix;
    }



}
