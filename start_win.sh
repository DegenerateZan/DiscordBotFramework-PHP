#!/bin/bash
# use this if you are desparete to using it on windows and fill the pidbot manually
# requirement to use this on windows  ! use GIT BASH
rm -rf cache/pidbot.txt

php kernel serve

php Framework/init/init.php & > /dev/null & 
echo $! > pidbot

#echo $! > cache/pidbot.txt #WHY THE FUCK is this simple shits doesnt work
mv pidbot cache/pidbot.txt # and instead i did this awful way
echo PID : $!



sleep 15
php Framework/init/initCrashHandler.php;



