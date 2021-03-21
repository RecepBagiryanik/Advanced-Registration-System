<?php 

try {
	$db = new pdo("mysql:host=localhost;charset=utf8;dbname=project","root","");
} catch (PDOException $e) {
	$e=GetMessage();
}

 ?>