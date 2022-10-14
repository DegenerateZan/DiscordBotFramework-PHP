<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\User\Activity;

require MAINBOT.'Commands/CommandController.php';
require MAINBOT.'Core/Logger.php';
require MAINBOT.'Core/Time.php';
require MAINBOT."Extensions/Fstream.php";
require MAINBOT."Extensions/MiniMessageHandler.php";


// this is Beta Version of the Main Controller 
class MainController {
    private $discord,
            $ins_key = 0,
            $core;
    public  $prefix;
                  
            
            
    public function __construct($discord){
            $this->discord = $discord;    
            self::setCore();
            self::setPresence();
            self::loadPrefix();
    }
    public function setCore(){
        $this->core['time'] = (object) new Time();
        $this->core['settings'] = (object) json_decode(file_get_contents(MAINBOT."Config/botsettings.json"));
        Fstream::Fwrite(ROOT."cache/pidbot.txt",getmypid());
        if (!isset($this->core['settings']->prefix)) throw new Exception("Cannot Get the default Prefix!\n");
        
    }
    public function setPresence(){

        $discord = $this->discord;
        $activity = new Activity($discord, [
            'name' => "r!help >> if you need me",
            //'name' => "With my master's dick",
            'type' => Activity::TYPE_PLAYING,
        ]);
    
        $discord->updatePresence($activity);
    }

    public function initCommandController($message, $content){
        $ins[$this->ins_key] = (object) new CommandController( $this->discord, $message, $content, $this->core);
        if($ins[$this->ins_key]->destroy) $ins[$this->ins_key] = null;
        $this->ins_key++;
    }
    public function loadPrefix(){
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

        
        
        
        echo "++++++++++++++++ PREFIX DETECTED, EXECUTING COMMAND ++++++++++++++++\n";            

        $content = trim($content, $maincontroller->prefix);
        $maincontroller->initCommandController($message, $content);
    });


}