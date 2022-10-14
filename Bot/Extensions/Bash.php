<?php

class Bash{

    private
        $dir_mode = array('./ria/bash/'.'./ria/cache/',
        '');
    
        public function runbash($commands, $path_mode){
            $path = $this->dir_mode[$path_mode];
            $old_path = getcwd();
            chdir($path);
            $output = shell_exec($commands);
            chdir($old_path);
        }

        public function setpath($script){
            $this->dir_mode[2] = $script;
        }

}