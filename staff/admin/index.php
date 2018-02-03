<?php require_once 'server/function.php'; ?>
<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="">
		<title>Master List</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
			<div id="alert_prompt" class="my_alert" style="overflow: hidden;"></div>
				<?php require_once 'interface/control.php'; ?>
			<div id="content"></div>
		</div>
		<?php require_once 'interface/modal.php'; ?>
		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="script/master.js"></script>
	</body>
</html>
