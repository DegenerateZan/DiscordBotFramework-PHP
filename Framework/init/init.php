<?php
chdir(dirname(dirname(__DIR__)));

include 'Framework/core/config.php';

truncate();
truncate_log();

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



