<?php 

$db_host = "localhost:3306";
$db_name = "estudos";
$db_user = "root";
$db_pass = "";

$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);

$array = [
	'error' => '',
	'result' => []
];