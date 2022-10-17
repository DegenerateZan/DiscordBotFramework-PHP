<?php

include 'config.php';

truncate();

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



