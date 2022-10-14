<?php 

$log = dirname(__FILE__)."./cache/system.crash.log";


$owner = file_get_contents("owner.txt");
$folder = "Bot/";
define('OWNER', $owner);
define('MAINBOT', $folder);
define("ROOT", __DIR__."/"); // the root of an discord bot
define("RED", "0xff0000");

// ini_set("display_errors", 1);
// // ini_set("log_errors", 1);
// // ini_set("error_log", $log);
// ini_set("date.timezone","Asia/Jakarta");

error_reporting(E_ALL);


