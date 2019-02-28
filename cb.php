<?php
	require_once "db.php";
	require_once "config.php";
	$db = new DB("db_cjd",CJD_USER,CJD_PASSWORD,"localhost");
	header('Content-type: application/json');
	$json = array();
	if(isset($_POST['word'])){
		session_start();
		$word = $_POST['word'];
		$word = str_split($word,3);
		$json = array(
			'id'	=> $_POST['id'],
			'word'	=> $_POST['word']
		);
		foreach ($word as $key => $value) {
			$res = $db->query('SELECT * FROM ims_cjd_emoji WHERE `words` LIKE "%'.$value.'%"');
			$count = 0;
			if($db->count() > 0){
				$json['emoji'] = $db->row(0)->code;
				//var_dump($db->row(0)->code);
				$json['msg'] = '匹配';
				$json['code'] = 1;
				$count++;
			}else{
				$json['msg'] = '暂无匹配';
				$json['code'] = 0;
				exit(json_encode($json));
				return false;
			}
		}
		if($count === 3){
			$_SESSION[$_POST['id']] = $_POST['word'];
		}
	}
	var_dump($_SESSION);
	exit(json_encode($json));