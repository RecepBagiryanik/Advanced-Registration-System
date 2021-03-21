<?php 
session_start();

function csrf() {
	if (isset($_POST["register"])) {
		if (!isset($_POST["csrftoken"]) || $_SESSION["csrftoken"] != $_POST["csrftoken"]) {
			return 0;
		} else {
			$_SESSION["csrftoken"] = md5(uniqid(rand(00000, 99999)));
			return 1;
		}
	}
}

if (!isset($_SESSION["csrftoken"])) {
	$_SESSION["csrftoken"] = md5(uniqid(rand(00000, 99999)));
}

?>