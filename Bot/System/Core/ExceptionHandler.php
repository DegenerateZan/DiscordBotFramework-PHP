<?php

use Discord\Parts\Channel\Message;

/**
 * This Class is Responsible to manage the Exception to report the bot
 */
class ExceptionHandler extends Exceptions{
    private     $message;
    protected   $exception,
                $exceptions; //the array lists of loaded exeptions from ini file

    public function __construct(Message $message){
        $this->message = $message;
    }

    public function setCustomException(string $exception){
        $this->exception = $exception;
    }

    public function setException(int $exception_code){
        $this->exception = $this->exceptions[$exception_code];
    }

    public static function new(Message $message){

        return new ExceptionHandler($message);
    }

    public function sendException(){
        MiniMessHandler::sendMess($this->message, $this->exception);
    }
    
}


class Exceptions {

    /**
     * It'll load the ini file
     */
    public function loadExceptions(){
        $location = MAINBOT."Config/exeptions.ini";
        php_ini_loaded_file($location);
    }
}