<?php

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Channel\Message;

 class Speedtest{
    public  $type = "Internal",
            $privilege = "public",
            $permitted_cmd_type = "message";
    private $discord,
            $message,
            $updated_mess,
            $result,
            $builder,
            $embed,
            $json;

    public function __construct(Discord $discord,$message){
        $this->discord = $discord;
        $this->message = $message;
        //your custom constructor here
    }
    public function init(){
        $this->message->reply("Please Wait, Attempting to Calculate ...")->done( function(Message $message){
            $this->updated_mess = $message;

            self::getJson();
            //self::validation();
            self::MessBuilder();
            self::sendResult();
        });
    }
    private function fail(){
        $this->embed = new Embed($this->discord);
        if(strlen($this->log) < 1900)$this->embed->setDescription("Failed to get Json,\nLog : ". $this->log);
        // else { Fstream::Fwrite(ROOT."cache/temp/Speedtestlog", $this->log);
        //     $this->embed->setDescription("Failed to get Json,\nLog : ");}
    }
    private function validation(){
        
        if(!$this->result === NULL) self::fail();
        else self::PassedEmbedBuilder();
    }
    private function getJson(){
        $curdir = __DIR__;
        chdir(ROOT);
        $json = exec(ROOT."External-bin/speedtest.exe --format json");
        // $json = Fstream::Fread("cache/temp/speedtest.result.log");
        $this->log = $json;
        // $skuList = preg_split('/\r\n|\r|\n/', $json);
        chdir($curdir);
        $this->result = json_decode($json);
        self::validation();
    }

    private function MessBuilder(){
        $mess_bulider = new MessageBuilder();
        $mess_bulider->addEmbed($this->embed);
        $this->builder = $mess_bulider;
    }

    private function PassedEmbedBuilder(){
        $this->embed  = new Embed($this->discord);
        $a = $this->result;
       
        $this->embed   
                ->setColor(RED)
                ->setTitle("Your speedtest results are:")
                
                ->setDescription("```Server   : ".$a->server->name." - ". $a->server->location."\n".
                                    "ISP      : $a->isp\n".
                                    "Latency  : ".$a->ping->latency." (".$a->ping->jitter."ms jitter)\n".
                                    "Download : ".(float) $a->download->bytes/1024/1000  . " MBps\n".
                                    "Upload   : " . (float) $a->upload->bytes/1024/1000 - 7  . " MBps\n". 
                                    "Packet loss: ". $a->packetLoss. "```")
                ->setImage($a->result->url.".png")
                ->setFooter(Time::getCurrentTime());
               //->setFooter(preg_replace('/[^A-Za-z0-9\-]/', '', $string););
               echo "THIS PASSED\n";


       
    }
    private function sendResult(){
        $this->updated_mess->channel->sendMessage($this->builder)->done(function(){
            $this->updated_mess->delete();
        });

    }




 }