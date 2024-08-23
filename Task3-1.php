<?php
    // It returns the current day
    echo date("j") . "<br>";  // Adds a newline space after the day
    $day = date("j");
    echo $day . "<br>";  // Adds a newline space after the day
    // It returns the current month
    echo date("m") . "<br>";  // Adds a newline space after the month
    // It returns the current year
    echo date("Y") . "<br>";  // Adds a newline space after the year
    echo strlen("Hello! How are you?");
    echo "<br>";
    echo dirname(__FILE__) . "<br>";  // Outputs the directory of the current file
    include_once("task2.php");  // Include the file from the same directory
    echo "<br>";
    echo "probando php_self::::" . $_SERVER["PHP_SELF"];
    echo "<br>";
    echo "Server: " . $_SERVER["SERVER_NAME"];  
?>