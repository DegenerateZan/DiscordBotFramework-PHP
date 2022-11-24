<?php


class Serve {

    private $argv;

    public function __construct($argv){
        $this->argv = $argv;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') die("Windows Platform Detected, sorry this command only supported on linux\n");
        echo "proceed to start the Server!\n";
        self::validate();
        //if(self::validate) self::serveUnixType();
    }

    public function validate(){
        $check = self::check();
        if(!in_array('--force',$this->argv) && in_array(true, $check, true)) die("cannot start server, \nError : CrashHandler and Init instance(s) is still running!,\nto check the all the running process use 'php kernel allprocess'\n");
        if(!in_array('--force',$this->argv) && $check[1]){ echo "Warning : initCrashHandler.php instance(s) is still running!" .PHP_EOL;
            self::startInit();
        } else {
            if($check[1]) new Kill;
            self::serveUnixType();
        }

    }

    private function check(): array{
        $process = [false, false];
        $ps = shell_exec(" ps aux | grep -i php");
        // true if the process is found
        if (str_contains($ps, 'init.php')) $process[0] = true;
        if (str_contains($ps, 'initCrashHandler.php')) $process[1] = true;

        return $process;

    }

    public function serveWinType(){

    }

    private function startInit(){
        exec(sprintf("%s > %s 2>&1 & echo $! > %s", "php Framework/init/init.php" , "cache/stdout.mainbot.log", "pid"));
        // //exec(sprintf("%s & echo $! > %s", "php Framework/init/init.php", "cache/pidbot.txt"));
        exec("rm -rf cache/pidbot.txt");
        sleep(1); // creating a buffer
        exec("mv pid cache/pidbot.txt");

        echo "stdout of Main Bot has been redirected to : " . colorLog("'cache/stdout.mainbot.log'", 's');
        
    }

    private function startCrashHandler(){
        exec(sprintf("%s > %s 2>&1 & echo $! > %s", "php Framework/init/initCrashHandler.php" , "cache/stdout.crashhandlerbot.log", "/dev/null"));
            
        echo "\nstdout of CrashHandler has been redirected to : " . colorLog("'cache/stdout.crashhandlerbot.log'", 's') . PHP_EOL;

    }

    private function serveUnixType()
    {
            self::startInit();
            self::startCrashHandler();
            // file_put_contents("./.temp", "<?php\n\n unlink(_FILE_); \nrequire 'System/init/init.php'; ");
            // file_put_contents("./.temp2", "<?php\n\n unlink(_FILE_); \nrequire 'System/init/initCrashHandler.php'; ");
            
            // exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));


        
       
    }
}