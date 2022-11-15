<?php

require COMMANDS_DIR."misc/Ping.php";
require COMMANDS_DIR."misc/Eval.php";

require COMMANDS_DIR."System/addSlashCommand.php";
require COMMANDS_DIR."System/SystemControl.php";
    use Discord\Discord;
    use Discord\Parts\Channel\Message;
    
    use Spatie\Async\Pool;






/**
 * this class is responsible to inherite the default method & properties of
 * message command model tipe 
 */
abstract class MessageCommand {
    public      $permitted_cmd_type = "message";
    protected   $discord,
                $message,
                $content,
                $core;
    
    protected   $pool; // the asyncronize object in case it need it

    public function __construct(Discord $discord, Message $message, $content, $core){
        $this->discord = $discord;
        $this->message = $message;
        $this->content = $content;
        $this->core    = $core;


        $this->pool = Pool::create();

    
    }



}


