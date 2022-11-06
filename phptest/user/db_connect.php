
<?php
	// DB 접속
	$db = new PDO("mysql:host=uws7-028.cafe24.com;port=3306;dbname=movieverse", "movieverse", "ww970714**");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>