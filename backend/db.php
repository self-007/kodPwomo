<?php
$host = "localhost";
//$nameProject="u210643046_wegamer"; //u210643046_wegamer
//$userName="u210643046_lifegamer";
//$passsword="01234weGamer$";
// For local development, you can uncomment the following lines and comment the above ones
 $userName = "root";
 $passsword = "";
 $nameProject = "kodpwomo";

try {
    $connection = new PDO("mysql:host=" . $host . ";dbname=" . $nameProject, $userName, $passsword);
    $connection->exec('SET NAMES utf8');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $i) {
    echo "echec de la connexion a la base de donne" . $i->getMessage();
}