<?php


class AllProcess {
    public function __construct()
    {
        echo "Showing all PHP Process\n";
        echo shell_exec(" ps aux | grep -i php") . PHP_EOL;
       
    }

}