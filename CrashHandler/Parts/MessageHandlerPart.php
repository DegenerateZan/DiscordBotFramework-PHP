<?php

use Discord\Builders\MessageBuilder;
use Discord\Parts\Embed\Embed;

class MessageHandlerPart{
    public $reason;
    public $embed,
            $message_builder;
            
    public function reason(){
        switch ($this->data->command_type){
            case 'Internal':
                $reason = "Fatal Error : Kernel Error 1\nBot Mengalami Crash / Serangan Jantung \nsetelah berusaha menjalankan Script PHP kode internal, Harap Hubungi Developer";
                break;
            case 'External':
                $reason = "Fatal Error : Kernel Error 2\nBot Mengalami Crash / Serangan Jantung \nsetelah melakukan Injeksi Script PHP kode External Menggunakan Mode Ring 0";
                break;
            default:
                $reason = "Fatal Error : Kernel Error 0\nBot Mengalami Crash / Serangan Jantung \nPenyebab tidak Diketahui....";
                break;


        }
        $this->reason = $reason;
        

        
    }

    public function embedWarning(){
        
        $embed = new Embed($this->discord);
        $embed 
                ->setType("rich")
                ->setDescription("Crash Handler V 1.0")
                ->setColor("0x070d0e")
                ->addField([
                    "name"=> "Perintah yang digunakan",
                    "value"=> "```" .$this->data->command . "```"
                ])->addField(
                [
                    "name"=> "\u{200b}",
                    "value"=> "Direquest Oleh ".$this->user
                ])->addField(
                [
                    "name"=> "\u{200b}",
                    "value"=> 'Waktu Terakhir Perintah Di eksekusi'. "\n" . $this->data->last_time_execution
                ])
                ->setFooter( "Crash Handler Powered using Zan Discord Framework",
                "https://cdn.discordapp.com/attachments/997562428529328188/1027912099848007680/Framework_Logo.png")
                ;
        $this->embed = $embed;

    }
    public function messbuilder(){

        $message_builder = MessageBuilder::new();

        if (strlen($this->log) < 1950){ 
            $message_builder->setContent("mencoba memuntahkan crash log\n```$this->log```") ;
            $message_builder->setContent($this->reason)->addEmbed($this->embed);
        }else{
            $message_builder->setContent("mencoba memuntahkan crash log")->addFile("system.crash.log");
            $message_builder->setContent($this->reason)->addEmbed($this->embed);
    }

      
        // $message_builder->setContent("SHIT");
        $this->message_builder = $message_builder;
        echo("endmessbuilder\n");
    }
}


