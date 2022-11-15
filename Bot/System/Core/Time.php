<?php


class Time {
    public  $timestamp,
            $start,
            $end;
    public static function getCurrentTime(){
        $date = date('[h:i:s] d-M-Y ');
        return $date;
    }
    public function setEndTime(){
        $this->end = time();
    }
    public function __construct(){
        $this->start = time();

    }
}