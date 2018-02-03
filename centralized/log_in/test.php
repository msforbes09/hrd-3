<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Foundation Section</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="alert">
		<h4>Please log-in using your 7 digit ID number.</h4>
		<h4>Example: 0012345</h4>
	</div>
	<div class="wrapper">
		<div class="container">
			<div class="welcome">
				<p style="font-size: 40px;">Welcome</p>
			</div>
			<div class="form">
				<input id="username" type="text" placeholder="Username">
				<input id="password" type="password" placeholder="Password">
				<button id="login-buttona">Login</button>
			</div>
			<h3 id="alert" style="color: red;"></h3>
		</div>
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<script src='../bootstrap/js/jquery-3.2.1.js'></script>
	<script  src="js/index.js"></script>
</body>
</html>
