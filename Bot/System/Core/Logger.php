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

    Fstream::Fwrite("cache/system.crash.jsonc", $json);

    }

    /**
     * this Method is to Parse or replace the Leak Token off from a string (make SURE that the string that you wanted to parse is not null otherwise i would crash)
     * 
     * @return clean_string
     */
    public static function parseToken($string){
        if (is_null($string)) return;
        return str_replace(getkey(), "TOKEN" ,$string);
    }

    public static function jsonLogDump(object $json, $filename = "json.dump.log"){
        $json = json_encode($json, JSON_PRETTY_PRINT);

        $loc = "./cache/". $filename;
        Fstream::Fwrite($loc, $json);
    }
}