<?php

use Spatie\Async\Pool;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;

class Warning {

    public $permission;

    private $message_warning,
            $message_response,
            $clone_discord;
        
    private $text = ["Yes Master, I'm glad you choose to not let me suffer", "Yes Master, Understood"],
            $channel;

    public function sendWarningExperimentalCommand( Message $message,Discord $discord){
        $text = "I'm Sorry Master, this command is Marked as still in **_Experimental Stage_**,\nif you insist to run, this Command can cause the Bot to Crash, if it goes wrong!";

        $builder = new MessageBuilder();
        $builder->setContent($text);
        $message->channel->sendMessage($text)->done(function (Message $message) use ($discord){

            $this->clone_discord = clone $discord;


            $pool = Pool::create();
            
                $pool->add(function () use ($message ) {


                    $this->message_warning = $message;
                    $this->clone_discord->on('message', function(Message $message){
                        $m = $message->content;
                            echo $m;
                        if ($message->author->id == OWNER){
                            
                            // if (str_contains( $m ,"yes")){
                            //     $this->message_warning->delete();
                            //     $this->permission = 1;
                            //     $this->channel = $message->channel;
                            //     unset($this->clone_discord);
                            // } elseif (str_contains($m, "no")){
                            //     $this->message_warning->delete();
                            //     $this->permission = 0;
                            //     $this->channel = $message->channel;
                            //     unset($this->clone_discord);

                                
                            // }
                        }
                    });


                })->then(function ($channel) {
        
                    $channel->sendMessage($this->text[$this->permission]);
                })->catch(function (Throwable $exception) {
                    // Handle exception
                });


                $pool->wait();





        });

    }




    public function sendNotNSFWChannelWarning(Message $message,Discord $discord){
        $embed = new Embed($discord);
        $embed->setColor(RED)->setImage("https://images-ext-1.discordapp.net/external/sMqLmfv-squHRvye96gKhyx-K5YthKxkW6Q2uVBpAlQ/https/gitlab.com/d0g/cdn/-/raw/main/nsfw.gif");
        $message_builder = MessageBuilder::new()->setContent("My condolence, Master, this channel is not marked as **NSFW** / **Age-Restricted**\nPlease make sure you run command on NSFW Channels.")->addEmbed($embed);
        MiniMessHandler::sendMess($message, $message_builder);
    }


}