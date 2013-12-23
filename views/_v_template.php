<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
		<!-- CSS/JS common to whole app -->				
		<link rel="stylesheet" href="/css/master.css" type="text/css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script>

		<!-- Controller Specific JS/CSS -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
	</head>

	<body>	

	    <div id='menu'>

	    	RUBBUR DUCK

	    </div>

	    <br>

		<?php if(isset($content)) echo $content; ?>

		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</body>
</html>