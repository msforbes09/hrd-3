<?php
require_once 'control.php';
require_once '../get_staff.php';
if ( $row["job_cate"] < 5 || $row["team"] <= 1){
	header('location: ../plan_monitoring');
}
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
		<link href="../bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="sheet/admin.css" rel="stylesheet">
		<?php require_once 'interface/sheet.php'; ?>
	</head>
	<body>
			<?php require_once '../viewer/log.php'; ?>
			<?php require_once 'interface/header.php'; ?>
		<div class="container-fluid">
			<?php require_once 'interface/control.php'; ?>
			<div id="content" class="float" style="height: 735px;padding-top:45px;"></div>
			<?php require_once 'interface/modal.php'; ?>
		</div>

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="../bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
		<script src="script/admin.js"></script>
		<script src="script/syscom.js"></script>
	</body>
</html>
