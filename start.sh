#!/bin/bash
rm ./cache/pidbot.txt
php init.php & > /dev/null & 
#echo $! > cache/pidbot.txt WHY THE FUCK is this simple shits doesnt work
echo $! > pidbot.txt
mv pidbot.txt cache/pidbot.txt # and instead i did this awful way
echo PID : $!



sleep 15
php initCrashHandler.php 
