#!/bin/bash
rm -rf .temp1
rm -rf .temp2 

rm -rf cache/pidbot.txt

php kernel serve

php .temp1 & > /dev/null & echo $! > pidbot.txt

#echo $! > cache/pidbot.txt #WHY THE FUCK is this simple shits doesnt work
mv pidbot.txt cache/pidbot.txt # and instead i did this awful way
echo PID : $!



sleep 15
php .temp2



