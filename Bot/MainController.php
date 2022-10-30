<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Interactions\Interaction;
use Discord\Parts\User\Activity;
use Discord\WebSockets\Event;

//CommandControllers
require MAINBOT.'Controllers/MessageCommandController.php';
require MAINBOT.'Controllers/SlashCommandController.php';
// Core
require MAINBOT.'Core/Logger.php';
require MAINBOT.'Core/Time.php';
// Extentsions
require MAINBOT."Extensions/Fstream.php";
require MAINBOT."Extensions/MiniMessageHandler.php";


 
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
        $this->core['settings'] = (object) json_decode(file_get_contents(MAINBOT."Config/botsettings.json"));
        //Fstream::Fwrite(ROOT."cache/pidbot.txt",getmypid()); //im mistaken that i thought that the pid is changed after the disocord event loop is executed
        if (!isset($this->core['settings']->prefix)) throw new Exception("Cannot Get the default Prefix!\n");
        
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
$maincontroller;
function maincontroller($discord){
        global $maincontroller;


    echo "Discord Bot Siap Bertugas!\n";

    if (!isset($maincontroller)) $maincontroller = new MainController($discord);
    $discord->on('message', function(Message $message){
        global $maincontroller;
        $content = $message-> content;
        $condition = strpos($content, $maincontroller->prefix);
        if ($condition != 0 || $condition === false) return;

        
        
        
        echo "\n++++++++++++++++ MESSAGE COMMAND PREFIX DETECTED, EXECUTING COMMAND ++++++++++++++++\n";            

        $content = trim($content, $maincontroller->prefix);
        $maincontroller->initMessCommandController($message, $content);
    });

    $discord->on(Event::INTERACTION_CREATE, function(Interaction $interaction) use ($maincontroller){
        $maincontroller->initSlashCommandController($interaction);
    });

}
