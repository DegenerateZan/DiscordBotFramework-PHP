<?php



class SystemControl extends MessageCommand{
    public  $type = "Internal",
            $privilege = "owner";


    public function editConfig(){
        $value = get_string_between($this->content, "'", "'");
        $name = get_string_between($this->content, '"', '"');
        $config_handler = new ConfigHandler;
        $config_handler->setConfig();
        $json = $config_handler->getConfig();
        if(property_exists($json, $name)){
            $value = ($value == "false") ? false : $value;
            $value = ($value == "true") ? true : $value;
            $json->$name = $value;
            $config_handler->saveConfig($json);
            MiniMessHandler::sendMessWithCountDown($this->message, "Update Bot Settings for [" . $name . "]  has completed", 9, $this->discord);
        } else {
            MiniMessHandler::sendMessWithCountDown($this->message, "Cannot update [" . $name . "], the selected property doesnt exist", 9, $this->discord);

        }
    }
}