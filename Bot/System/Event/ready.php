<?php

function ready($discord){
        global $maincontroller;

    echo "Discord Bot Siap Bertugas!\n";

    if (!isset($maincontroller)) $maincontroller = new MainController($discord);

    message_event($discord);

    interaction_event($discord);

}
