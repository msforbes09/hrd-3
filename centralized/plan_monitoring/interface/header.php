<canvas id="canvas" style="position:absolute; z-index:-1"></canvas>
<?php if(date("m") == 12 && date("d") > 25){ ?>
	<img id="assist_1" src="images/animated-moon-image-0005.gif" style="height:140px; width:250px; position:absolute; top:50px; left:80%; z-index:-1; cursor: pointer; opacity: 0.8;]" title="">
<?php }?>
<div class="container-fluid">
	<h1 class="syscom">FOUNDATION DESIGN WAKUGUMI PLAN MONITORING</h1>
	<div id="alert_prompt" class="my_alert" style="overflow: hidden;">
	<?php
	try {
		$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$stmt = $pdo->prepare(
		"select note from monitoring_notes
		where
		group_id = 0
		order by note_id desc limit 0,1");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		echo $row["note"];
		} catch( PDOException $e ) {
			echo $e->getMessage();
		}
	$pdo = null;
	?>
	</div>
</div>
	<!--
-->