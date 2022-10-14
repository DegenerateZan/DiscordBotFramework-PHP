<?php

// this class is responsible to log the command detail to handle if the bot is crash after executing command
class Logger {
    private $command_type,
            $command,
            $id_channel,
            $id_guild,
            $id_message,
            $requsted_by,
            $last_time_execution;

    public function __construct($type, $message){
    //public function __construct($command_type, $id_channel, $id_channel, $requsted_by){
            $this->command_type = $type;
            $this->command = $message->content;
            $this->id_channel = $message->channel_id;
            $this->id_guild = $message->guild_id;
            $this->id_message = $message->id;
            $this->requsted_by = $message->author->id;
            $this->last_time_execution = Time::getCurrentTime();
            self::set();
    }

    private function set(){
        $log = ["command_type" => $this->command_type,
                "command" => $this->command,
                "guild_id" => $this->id_guild,
                "channel_id" => $this->id_channel,
                "message_id" => $this->id_message,
                "requested_by"=> $this->requsted_by,
                "last_time_execution" => $this->last_time_execution ];
    

    $json = json_encode($log);
    Fstream::Fwrite(ROOT."cache/system.crash.jsonc", $json);

    }
}

// $template = '{   
    
//     "command_type" : "", //internal atau External
//     "command" : "r!InjectPHP", // command yang diminta
//     "guild_id" : "990766953230659675", // server id
//     "channel_id": "990775255293382667", // channel id
//     "message_id" : "1026090341331386378",  // string datatype
//     "requested_by" : "599926912193921036", //id user
//     "last_time_execution" : "[12:10:48] 07-10-2022 " // date datatype
// }';