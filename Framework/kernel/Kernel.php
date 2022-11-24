<?php

require 'Framework/kernel/Serve.php';
require 'Framework/kernel/Help.php';
require 'Framework/kernel/CreateCommand.php';
require 'Framework/kernel/Kill.php';
require 'Framework/kernel/AllProcess.php';

define("KERNEL_VERSION", "Beta 0.5.0");

class Kernel {
    public function __construct($argv){
        $string = "Initializing Discord Bot kernel Version " . KERNEL_VERSION ;
        $outline = str_repeat( "=",strlen($string) + 2);
        $result = $outline . "\n" . "|" . $string . "|\n" . $outline;
        echo  $result."\n";
        if(!isset($argv[1])){
            echo "please specify the parameters!" . PHP_EOL;
            die;
        }
        $class = ucfirst($argv[1]);
        if(!class_exists($class)){ echo "Unknown Parameter [" . $argv[1] . "]".PHP_EOL; return;}

        new $class($argv);
    
    }
}