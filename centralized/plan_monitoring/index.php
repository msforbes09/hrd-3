<?php
require_once 'control.php';
require_once '../get_staff.php';
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
		<link href="sheet/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
		<table class="welcome_table">
			<tbody>
				<tr>
					<td rowspan="5" style="width: 20%; text-align: center;">
						<img src="../staff_pic/<?php echo $row["image"]; ?>" style="border-radius: 50%; border: 1px solid #696969; height: 180px; width: 180px;" />
					</td>
					<td style="width: 75%;">Name : <?php echo $name; ?></td>
				</tr>
				<tr>
					<td style="width: 75%;">Employment Status : <?php echo $row["employment_stat"]; ?></td>
				</tr>
				<tr>
					<td style="width: 75%;">Position : <?php echo $row["job_cate_desc"]; ?></td>
				</tr>
				<tr>
					<td style="width: 75%;">Team Name : <?php echo $row["team_name"]; ?></td>
				</tr>
				<tr>
					<td style="width: 75%;">Job Designation : <?php echo $row["job_desc"]; ?></td>
				</tr>
			</tbody>
		</table>
		<!--
		<h1>HELLO <?php echo $row["nick_name"]; ?>!</h1>
		-->
		<h1>Press SHIFT + F5 to check updates!</h1>
		<hr />
		<a href="monitoring.php"><span class="glyphicon glyphicon-open-file"></span> Plan Monitoring (user)</a><br />
		<a href="finished.php"><span class="glyphicon glyphicon-open-file"></span> Finished Plans</a><br />
		<a href="fd_monitoring_viewing.php"><span class="glyphicon glyphicon-open-file"></span> Ongoing Plans (read-only)</a><br />
		<a href="kibiroi_monitoring.php"><span class="glyphicon glyphicon-open-file"></span> Kibiroi Monitoring</a><br />
		<hr />
		<a href="admin.php"><span class="glyphicon glyphicon-open-file"></span> Plan Monitoring (admin)</a><br />
		<!--
		-->
		<a href="../master_list"><span class="glyphicon glyphicon-open-file"></span> Master List (foundation design)</a><br />
		<hr />
		<a href="about.txt" target="_blank"><span class="glyphicon glyphicon-question-sign"></span> About</a><br />
		<a href="../log_in/log_out.php"><span class="glyphicon glyphicon-remove-sign"></span> Sign-out</a><br />
		<hr />
		</div>

		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php require_once '../viewer/log.php'; ?>