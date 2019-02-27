<?php
	require_once "db.php";
	require_once "config.php";
	$db = new DB("db_cjd",CJD_USER,CJD_PASSWORD,"localhost");
	header('Content-type: application/json');
	$json = array();
	if(isset($_POST['word'])){
		$json['word'] = $_POST['word'];
	}
	exit(json_encode($json));