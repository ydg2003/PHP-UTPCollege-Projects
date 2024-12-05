<?php 
//login.php
 $host = 'localhost'; // Change as necessary
 $data = 'evento'; //dbname Change as necessary
 $user = 'root'; //username Change as necessary
 $pass = ''; //password Change as necessary
 $chrs = 'utf8mb4'; //charset Character set
 $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
 $opts =
 [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
]; //$options