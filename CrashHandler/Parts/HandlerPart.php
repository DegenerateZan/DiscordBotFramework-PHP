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

    /**
     * @deprecated
     *
     * @return $this
     */
    // fetch the rezuester's (user) object
    public function getuserbyid($id){
        $discord = $this->discord;
        $discord->guilds->get('id', $this->data->guild_id)
            ->members->fetch($this->data->requested_id)->then( function (Member $Member){
                $this->requsted_user = $Member;

            });
    }

}