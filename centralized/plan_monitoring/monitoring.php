<?php
require_once 'control.php';
require_once '../get_staff.php';
?>
<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="">
		<title>Plan Monitoring</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="sheet/user.css" rel="stylesheet">
		<?php require_once 'interface/sheet.php'; ?>
	</head>
	<body>
		<?php require_once '../viewer/log.php'; ?>
		<?php require_once 'interface/header.php'; ?>
		<input type="hidden" id="team_id" value="<?php echo $team; ?>" />
		<input type="hidden" id="staff_id" value="<?php echo $id; ?>" />
		<div class="container-fluid">
			<div id="summary" class="float" style="height: 180px;"></div>
			<div id="content" class="float" style="height: 550px;"></div>
		</div>
		<div id="clipboard"></div>
		<?php require_once 'interface/modal.php'; ?>

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="script/forbes.js"></script>
		<script src="script/syscom.js"></script>
		<?php require_once 'interface/script.php'; ?>
	</body>
</html>
