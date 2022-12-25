<?php

use Discord\Discord;
use Discord\Parts\Interactions\Interaction;
use Discord\WebSockets\Event;


function interaction_event(Discord $discord){
    global $maincontroller;
    $discord->on(Event::INTERACTION_CREATE, function(Interaction $interaction) use ($maincontroller){
        $maincontroller->initSlashCommandController($interaction);
    });
}