<?php

class Kill {

    public function __construct(){
        echo "killing all init & initCrashHandler processes\n";
        exec("bash Framework/scripts/kill_all_php.sh");
    }

}