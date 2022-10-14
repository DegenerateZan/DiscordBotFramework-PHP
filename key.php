<?php

function getkey(){
    $file = fopen("key.txt", "r");
    return fread($file, 10000);
}