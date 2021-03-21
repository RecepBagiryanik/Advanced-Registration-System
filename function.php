<?php 

function error($text) {
 return "<div class=\"alert alert-danger\" role=\"alert\">".$text."</div>";
}

function success($text) {
 return "<div class=\"alert alert-success\" role=\"alert\">".$text."</div>";
}

function filteredcontent($text) {
 $filteredcontent=array("<script>","</script>");
 $filteredtext=str_replace($filteredcontent, "", $text);
 return htmlspecialchars($filteredtext);
}

function emailcheck($text) {
 $emailcheck=explode("@", $text);
 if ($emailcheck[1] == "gmail.com" or $emailcheck[1] == "hotmail.com" or $emailcheck[1] == "outlook.com" or $emailcheck[1] == "yandex.com" or $emailcheck[1] == "icloud.com") {
 	return 1;
 } else {
 	return 0;
 }
}

function checkusername($text) {
	return preg_match("/[^a-zA-Z0-9_]/", $text);
}
?>
