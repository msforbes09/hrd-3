<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="">
		<title>Plan Monitoring</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="sheet/finished.css" rel="stylesheet">
		<?php require_once 'interface/sheet.php'; ?>
		<script>
		function search_focus(){
			$("#search").focus();
		}
		</script>
	</head>
	<body onload="search_focus()">
		<?php require_once '../viewer/log.php'; ?>
		<?php require_once 'interface/header.php'; ?>
		<div class="container-fluid">
			<?php require_once 'interface/finished_control.php'; ?>
			<div id="content" class="float" style="height: 660px;"></div>
		</div>		

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="script/finished.js"></script>
		<script src="script/syscom.js"></script>
		<?php require_once 'interface/script.php'; ?>
	</body>
</html>
