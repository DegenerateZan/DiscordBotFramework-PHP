<?php

use Discord\Discord;
use Discord\Parts\Interactions\Command\Command;
use Discord\Parts\Channel\Message;

class addSlashCommand{

    public  $type = "Internal",
            $privilege = "owner",
            $permitted_cmd_type = "message";
    private $discord,
            $message,
            $content;

    public function __construct(Discord $discord, Message $message, $content){
        $this->discord = $discord;
        $this->message = $message;
        $this->content = $content;
        //your custom constructor here
    }

    public function init(){
        // the condition if the new added command is global or guild only
        $global = true;
        if(str_contains($this->content, "--guild-only")) $global = false;
        $name = get_string_between($this->content, "'", "'");
        $desc = get_string_between($this->content, '"', '"');
        if (strlen($name) < 1) {MiniMessHandler::sendMessWithCountDown($this->message, "The name of the new Command cannot be Empty!", 6, $this->discord);return;}
        if($global){
            $command = new Command($this->discord, ['name' => "$name", 'description' => "$desc"]);
            $this->discord->application->commands->save($command);
            MiniMessHandler::sendMessWithCountDown($this->message, "The new Global command has been added", 6, $this->discord);
        } else {
            $guildCommand = new Command($this->discord, ['name' => "$name", 'description' => "$desc"]);
            $guild = $this->discord->guilds->get('id', $this->message->guild_id);
            $guild->commands->save($guildCommand);
            MiniMessHandler::sendMessWithCountDown($this->message, "The new Guild only command has been added", 6, $this->discord);

        }
    }


}

