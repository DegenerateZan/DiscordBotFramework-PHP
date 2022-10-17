<?php 

include 'functions/functions.php';

include __DIR__.'/vendor/autoload.php';
if(!file_exists(".env")) die(".env file does not exist!,\nplease copy the or rename .env.example and fill the data!");



$log = dirname(__FILE__)."./cache/system.crash.log";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getkey(){
    return $_ENV["BOT_KEY"];
}
$folder = "Bot/";
define('OWNER', $_ENV["OWNER_ID"]);
define('MAINBOT', $folder);
define("ROOT", __DIR__."/"); // the root of an discord bot
define("RED", "0xff0000");


// echo OWNER.PHP_EOL.getkey();
// die;
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", $log);
ini_set("date.timezone","Asia/Jakarta");

error_reporting(E_ALL);


