<?php
	require_once "db.php";
	require_once "config.php";
	$db = new DB("db_cjd",CJD_USER,CJD_PASSWORD,"localhost");
	header('Content-type: application/json');
	$json = array();
	if(isset($_GET['random'])){
		$db->select('ims_cjd_emoji_idiom');
		$count = $db->count();
		$ram = rand(0,$count-1);
		$db->query("SELECT `emoji`,`idiom` FROM ims_cjd_emoji_idiom LIMIT ".$ram.",1");
		$json['code'] = 1;
		$json['emoji'] = trim($db->row(0)->emoji);
		$json['idiom'] = trim($db->row(0)->idiom);
	}

	die(json_encode($json));