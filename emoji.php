<?php
	require_once "db.php";
	require_once "config.php";
	$db = new DB("db_cjd",CJD_USER,CJD_PASSWORD,"localhost");
	$db->query("SELECT `name`,id FROM cjd_idiom WHERE LENGTH(`name`) = 12");
	$rows = $db->result();
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>emoji</title>
</head>
<body>
	<div id="time"></div>
	<div id="emoji">
	<?php foreach ($rows as $key => $value) { ?>
		<span data-id="<?=$value->id;?>"><?=$value->name; ?></span>
	<?php } ?>
	</div>
	<div id="result">
		
	</div>
</body>
</html>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
	
	function init(){
		var $this = $('#emoji span:first');
		var word = $this.text();
		var id = $this.data('id');
		insert(id,word);
	}
	init();
	function insert(id,word){
		$.ajax({
			url:'cb.php',
			data:{
				id:id,
				word:word
			},
			type:'post',
			dataType:'json'
		}).done(function(data){
			$('#result').append('<p>'+data.word+','+data.msg+'</p>');
			$('#emoji span:first').remove();
			init();
		})
	}
</script>