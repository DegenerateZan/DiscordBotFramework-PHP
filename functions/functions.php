<?php

function dd(...$streams){
    foreach($streams as $streams){
        var_dump($streams) . PHP_EOL;
    }
    die;
}