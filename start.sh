#!/bin/bash
php initCrashHandler.php & > /dev/null 2&>cache/script.log
php init.php & > /dev/null 2&>cache/script.log
