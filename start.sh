#!/bin/bash
rm cache/pidbot.txt
php init.php & > /dev/null & echo $! >cache/pidbot.txt
echo PID : $!



sleep 15
php initCrashHandler.php 
