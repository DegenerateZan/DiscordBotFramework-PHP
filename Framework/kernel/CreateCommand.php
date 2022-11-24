<?php


class CreateCommand {


    public function generate(){
        


    }
}

/*


function createcommand($argv){
    $unixfirstdir = exec("pwd");
    $firstdir = __DIR__;

    $exec = null;
    
    $unixtargetdir = "Bot/Commands";

    $targetdir = "Bot\Commands";
    echo $targetdir."\n";
    chdir("Bot\Commands");
    $create_c = null; $create_p = null; $on_c = null;
    foreach($argv as $arg){
        switch ($arg) {
            case 'createcommand':
                $key = array_search('createcommand',$argv) + 1;
                $create_c = "touch " . $argv[$key] . ".php\n echo '<?php\n class $argv[$key]{' >> " . $argv[$key] . ".php";
                break;
            case '--with-part':
                $key = array_search('createcommand',$argv) + 1;
                $create_p = "mkdir Parts\ncd Parts\ntouch " . $argv[$key] . "Part.php";

                break;
            case "--on-category":
                $key = array_search('--on-category',$argv) + 1;
                $on_c = "mkdir " . $argv[$key] . "\ncd " . $argv[$key];
                break;
            default:
               
                
            
        }
    }

    
    $exec .= "$on_c\n$create_c\n$create_p";

    chdir($firstdir);
    $file = "cache/kernel/kernelbatch.sh";
    file_put_contents($file, "#!/bin/bash\n".$exec);

    $sript = "bash $unixfirstdir/" ."$file";
    chdir($targetdir);
    exec($sript);
        //exec("cat $firstdir/cache/kernel/construct.txt >> $firstdir/cache/kernel/kernelbatch.sh");

    
}



*/