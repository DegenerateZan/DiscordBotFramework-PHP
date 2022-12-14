<?php

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;


 class Evalphp extends MessageCommand {
    public  $type = "External",
            $privilege = "owner",
            $permitted_cmd_type = "message";
    private $log = false;
    
    public function safemode(){
        $parsed_code = str_replace("```","\n",substr($this->content, strpos($this->content, "```"), strlen($this->content)));

        $cacheloc = "./cache/temp/logDebugRawCommand.txt";
        $phpfile = "./cache/temp/DebugRawCommand.php";
        Fstream::Fwrite($phpfile, $parsed_code);
        
        exec("php $phpfile 1 10000 > $cacheloc 2>&1");
        
        $debug = file_get_contents($cacheloc);
        $messbuilder = MessageBuilder::new();
        $embed = new Embed($this->discord);
        
        $embed->setColor(RED)->setDescription("Debug Safe Mode : Executing Raw PHP command has Been executed!\nMencoba Memuntahkan log
        ``` $debug ```");
        $messbuilder->addEmbed($embed);

            
            $this->message->channel->sendMessage($messbuilder)->done(function(Message $message){
                $arr = explode($this->content, " ");
                $arr_search = array_keys($arr ,"--auto-delete");
                if ($arr_search != NULL){
                    $arr_search =+ 1;
                    $count = (is_null((int) $arr[$arr_search])) ? 5 : (int) $arr[$arr_search];
                $loop = $this->discord->getLoop();
                $loop->addTimer($count, function() use ($message){
                    $message->delete();
                });
            }
            });
            
        

    }

    public function savemode(){
        
        $mess = "Typo Parameter Detected!
        ```
        r!evalphp savemode
                  ^^^^^^^ -------> you mean 'safemode'?
        ```";
        MiniMessHandler::sendMess($this->message, $mess);
    }

    public function init(){
        $this->content = str_replace("```php", "```", $this->content);
        echo $this->content;
        $parsed_code = str_replace(["```", "<?php"],"\n",substr($this->content, strpos($this->content, "```"), strlen($this->content)));
        try{
            
            eval($parsed_code);

        } catch (Exception $e){

        }

        if (!isset($this->log)) return;
        $loc = "cache/eval.log";
        Fstream::Fwrite($loc, Logger::parseToken($this->log));

        $loc = "cache/eval.log";
        
        $messbuilder = MessageBuilder::new()->setContent("Eval Log")->addFile($loc);
        
        MiniMessHandler::sendMessWithCountDown($this->message, $messbuilder, 15, $this->discord);

    }


    }