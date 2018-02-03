<?php
	session_start();
	if(isset($_SESSION["id"])){
		header('location: ../plan_monitoring');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="">
		<title>Foundation Portal</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="" rel="stylesheet">
		<link href="sheet/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
		<h1>HELLO VISITOR!</h1>
		<hr />
		<a href="finished.php"><span class="glyphicon glyphicon-open-file"></span> Finished Plans</a><br />
		<a href="fd_monitoring_viewing.php"><span class="glyphicon glyphicon-open-file"></span> Ongoing Plans (read-only)</a><br />
		<hr />
		<a href="about.txt" target="_blank"><span class="glyphicon glyphicon-question-sign"></span> About</a><br />
		<a href="../log_in"><span class="glyphicon glyphicon-user"></span> Sign-in</a>
		<hr />
		</div>

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php require_once '../viewer/log.php'; ?>