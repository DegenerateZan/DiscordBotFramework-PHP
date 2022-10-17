<?php

use Discord\Parts\User\Member;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class HandlerPart {
    public function template(){
        $this->template = '';
        
    }
    public function parse_json(){
        $json = $this->data;
        $json = preg_replace('!//.*!', '', $json);
        $this->data = json_decode($json);
    }
   
    function truncat(){
        $file_json = fopen("cache/system.crash.jsonc", "w");
        fwrite($file_json, '');
        $file_log = fopen("cache/system.crash.log", "w");
        fwrite($file_json, '');
    
    }



}