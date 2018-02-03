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
		<title>Kibiroi Monitoring</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="sheet/kibiroi.css" rel="stylesheet">
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
			<?php require_once 'interface/kibiroi_control.php'; ?>
			<table style="width: 100%;">
			<tr>
			<td style="width: 50%;"><div id="ordered" class="float" style="height: 692px;"></div></td>
			<td style="width: 50%;"><div id="error" class="float" style="height: 692px;"></div></td>
			</tr>
			</table>
		</div>
		<?php require_once 'interface/modal.php'; ?>
		

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="script/kibiroi.js"></script>
		<script src="script/syscom.js"></script>
		<?php require_once 'interface/script.php'; ?>
	</body>
</html>
