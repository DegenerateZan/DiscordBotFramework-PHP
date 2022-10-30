<?php

include 'config.php';

truncate();

require MAINBOT."MainController.php";

use Discord\Discord;
use React\EventLoop\Loop;

echo "Initializing PHP bot using Framework Version ".VERSION.PHP_EOL;

$discord = new Discord([
    'token' => getkey(),
    'loop' => Loop::get()
]);

$discord->on('ready', function (Discord $discord){
    maincontroller($discord);
});
$discord->run();



