<?php 


$dir = dirname(dirname(__DIR__));

include 'System/functions/functions.php';

include 'vendor/autoload.php';
if(!file_exists(".env")) die(".env file does not exist!,\nplease copy the or rename .env.example and fill the data!");

$log = "cache/system.crash.log";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

function getkey(){
    return $_ENV["BOT_KEY"];
}
$folder = "Bot/";
define('OWNER', $_ENV["OWNER_ID"]);
define('MAINBOT', $folder);
define('COMMANDS_DIR', MAINBOT."Commands/");
define("ROOT", $dir."/"); // the root of an discord bot
define("RED", "0xff0000");
define("VERSION", "1.9"); // the version of the main bot
define("CRASH_HANDLER_VERSION", "1.4"); // the version of a crash handler


// echo OWNER.PHP_EOL.getkey();
// die;
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", $log);
ini_set("date.timezone","Asia/Jakarta");

error_reporting(E_ALL);


