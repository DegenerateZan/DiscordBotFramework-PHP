<?php

class ConfigHandler {
    private $config,
            $location = MAINBOT."Config/botsettings.json";
    public function setConfig(){
        $this->config = (object) json_decode(file_get_contents($this->location));
    }

    public function saveConfig(object $config){
        $json = json_encode($config, JSON_PRETTY_PRINT);
        Fstream::Fwrite($this->location, $json);
    }
    public function getConfig(): object{
        return $this->config;
    }
    public static function loadAndGetConfig(){
        return (object) json_decode(file_get_contents(MAINBOT."Config/botsettings.json"));

    }
}