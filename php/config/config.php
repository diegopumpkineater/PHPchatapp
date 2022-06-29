<?php
$host = "localhost";
$dbname = "chat";
$user = "root";
$pass = "";
//CONNECT TO DATABASE
$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;


$options = [
    PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    PDO::MYSQL_ATTR_FOUND_ROWS => true
];
//PDO instance
try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}


//