<?php

    // global variables
    $core;
    $maincontroller;
    // Event
    require MAINBOT."System/Event/interaction.php";
    require MAINBOT."System/Event/message.php";
    require MAINBOT."System/Event/ready.php";
    // CommandControllers
    require MAINBOT.'System/Controllers/MessageCommandController.php';
    require MAINBOT.'System/Controllers/SlashCommandController.php';
    // Core
    require MAINBOT.'System/Core/Logger.php';
    require MAINBOT.'System/Core/Time.php';
    require MAINBOT.'System/Core/ExecutionTime.php';
    require MAINBOT.'System/Core/ConfigHandler.php';
    require MAINBOT.'System/Core/ExceptionHandler.php';
    require MAINBOT.'System/Core/Debug.php';
    // Extensions
    require MAINBOT.'Extensions/cURL.php';
    require MAINBOT.'Extensions/Fstream.php';
    require MAINBOT.'Extensions/MiniMessageHandler.php';
    require MAINBOT.'Extensions/Warning.php';
    // require MAINBOT.
    // require MAINBOT."System/";

