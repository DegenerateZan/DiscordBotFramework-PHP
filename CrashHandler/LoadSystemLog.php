<?php


class LoadSystemLog {
    const   Fail = array(false, NULL, NULL); // nilai gagal
    private $log,
            $pid,
            $json;

    public function getLog(){
        self::loadLog();
        return array($this->json, $this->log, $this->pid);
    }

    private function loadLog(){
        $this->json = fread(fopen("cache/system.crash.jsonc", "r"), 80000);
        $this->log = fread(fopen("cache/system.crash.log", "r"), 200000);

    }
    

    private function validate($output){
        $json = fread(fopen("cache/system.crash.jsonc", "r"), 80000);

        if(getnumberfromstring($output)) return false; // if the process found return fail and skip the send Message Procedure
        $string = "Main Bot Process has died!\n
                But cannot get the last message Command detail\n
                This Died Process can be caused by the Framework Exception or incorrectly Custom Command coding structure doesn't follow framework structure rules! ";
        if(strlen($json) < 3) die($string);

        return true;
      
    }


    public function checkShell()
    {
      

        $pid = (int) fread(fopen("cache/pidbot.txt", 'r'),1000);
        if(!$pid or $this->log === null) return false;
        $pid = $pid - 1;
        //jika process mati 
        $output = exec("ps -p $pid");
        return self::validate($output);
    }

}






/*

function getsystemlog(){
   
    $json = fread(fopen("cache/system.crash.jsonc", "r"), 80000);
    $log = fread(fopen("cache/system.crash.log", "r"), 200000);

    $fail = array(false, NULL, NULL); // nilai gagal
    
    $pid = (int) fread(fopen("cache/pidbot.txt", 'r'),1000);

    if(!$pid or $log === null) return $fail;
    $pid = $pid - 1;
    //jika process mati 
    $output = exec("ps -p $pid");
    
    // if(getnumberfromstring($output)) echo "\nNUMBER FOUND\n";
    // else echo "\nNUMBER NOT FOUND\n";
  
    if(getnumberfromstring($output)) return $fail; // if the process found return fail and skip the send Message Procedure
    else{ 
        if(strlen($json) < 3) die("Main Bot Process has died!\nBut cannot get the last message Command detail\nThis Died Process can be caused by the Framework Exception or incorrectly Custom Command coding structure doesn't follow framework structure rules! ");
        return array(true, $json, $log);
    }
    
}


*/