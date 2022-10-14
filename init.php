<?php

include 'config.php';
include __DIR__.'/vendor/autoload.php';
include 'functions/functions.php';

require_once "key.php";
require MAINBOT."MainController.php";

use Discord\Discord;

echo "Initialize PHP bot Version 1.0\n";

$discord = new Discord([
    'token' => getkey()
]);

$discord->on('ready', function (Discord $discord){
    maincontroller($discord);
});
$discord->run();



