<?php

class Help {

    public function __construct()
    {
        echo "Bot kernel Utility Help lists
    
        Kernel Command lists :
        [] <- ? inside of a square brackets example below its an optional parameter (do not add the brackets!)
    
        1 . create a command : 'php kernel createcommand <command_name> [ --with-part ] [--on-category <category_name>]'
        2 . kill all init & initCrashHandler processes : 'php kernel kill'
        3 . show all PHP process : 'php kernel allprocess'
        4 . start the Bot Server with Crash Handler : php kernel serve" .PHP_EOL;
    }
}