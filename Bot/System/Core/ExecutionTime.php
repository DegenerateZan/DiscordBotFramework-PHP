<?php

class ExecutionTime{

    private $time_start;

    public function __construct(){
        $this->time_start = microtime(true);
    }

    public static function new(){
        return new ExecutionTime();
    }

    public function getTimeExecution(){
        return 'Total execution time in seconds: ' . (microtime(true) - $this->time_start);
    }
}
