<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
		<!-- CSS/JS common to whole app -->				
		<link rel="stylesheet" href="/css/master.css" type="text/css">
	<!--
		<link rel="stylesheet" type="text/css" href="/css/framework.css">
		<link rel="stylesheet" type="text/css" href="/css/ducks.css">
	-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script>

		<!-- Controller Specific JS/CSS -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
	</head>

	<body>	

	    <div id='menu'>

	        <a href='/' class="menu_text">Home</a>

	        <!-- Menu for users who are logged in -->
	        <?php if($user): ?>

	            <a href='/users/logout' class="menu_text">Logout</a>
	            <a href='/users/profile' class="menu_text">Profile</a>

	        <!-- Menu options for users who are not logged in -->
	        <?php else: ?>

	            <a href='/users/signup' class="menu_text" id="register">Sign up</a>
	            <a href='/users/login' class="menu_text" id="signinXX">Log in</a>

	        <?php endif; ?>

	        <script type="text/javascript">
	        	$(function() {
	        		$('#signin').click(function() {
	        			$('#signin_div').show();
	        		})
	        	});
	        </script>

	        <script type="text/javascript">
	        	$(function() {
	        		$('#register').click(function() {
	        			$('#register_div').show();
	        		})
	        	});
	        </script>

	        <script type="text/javascript">
	        	var options1 = {
	        		type: 'post',
	        		url: 'process.php',
	        		success: function(response) {
	        			console.log("AJAx succes!");
	        			$('#signin_results').html(response);
	        		}
	        	}

	        	$('#signin_form').ajaxForm(options1);
	        </script>

<!--
	        <script type="text/javascript">
	        	var options2 = {
	        		type: 'post',
	        		url: 'process.php',
	        		success: function(response) {
	        			console.log("AJAx succes!");
	        			$('#reg_results').html(response);
	        		}
	        	}

	        	$('#reg_form').ajaxForm(options2);
	        </script>
-->

	    </div>

	    <br>

		<?php if(isset($content)) echo $content; ?>

		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</body>
</html>