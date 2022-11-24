#!/bin/bash 

#sudo pkill php-fpm
sudo kill -9 $(ps aux | grep -e 'php Framework/init/init.php' | awk '{ print $2 }') 
sudo kill -9 $(ps aux | grep -e 'php Framework/init/initCrashHandler.php' | awk '{ print $2 }') 
