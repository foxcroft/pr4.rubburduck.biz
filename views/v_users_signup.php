<head>
	<link rel="stylesheet" type="text/css" href="/css/master.css">
</head>
<body>
	<h1>Sign Up</h1>

	<form method='POST' action='/users/p_signup' id="reg_form">

		<strong>
			First Name <input type='text' name='first_name'><br>
			Last Name <input type='text' name='last_name'><br>
			Email <input type='text' name='email'><br>
			Password <input type='password' name='password'><br>
		</strong>

		<input type='submit' value='Sign Up!' /> 

	</form>

	<div id="reg_results"></div>

</body>