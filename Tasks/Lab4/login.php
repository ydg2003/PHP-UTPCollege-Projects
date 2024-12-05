<?php //db_conn.php
/* 
This PHP script defines the necessary configuration and options to establish a database connection 
using PDO (PHP Data Objects). It sets the required parameters for connecting to a MySQL database, 
specifying the hostname, database name, username, password, character set, and various PDO options.
The purpose of this script is to prepare the database connection settings, which can be used 
in other scripts to connect to the database securely and efficiently.
*/
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