<?php
$host = "localhost";
//$nameProject="u210643046_kodPwomo"; //u210643046_kodPwomo
//$userName="u210643046_kodPwomo";
//$passsword="KodPwomoCestPourPlusDe1000Users";
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