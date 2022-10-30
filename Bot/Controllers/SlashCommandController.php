<?php

use Discord\Discord;
use Discord\Parts\Interactions\Interaction;

/**
 * a Command controller for Discord Slash based type Command
 */
class SlashCommandController{

    private $discord,
            $interaction,
            $core;
    public $destroy = false;


    public function __construct(Discord $discord,Interaction $interaction, $core)
    {
        $this->discord = $discord;
        $this->interaction = $interaction;
        $this->core = $core;
        self::validation();
    }
    private function validation(){
        var_dump($this->interaction);
    }
}