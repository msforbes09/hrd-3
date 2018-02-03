<?php
$process_code = $_REQUEST["process_code"];
$proc = array('design','encode','check','qc');
$process = array('Designing','Encoding','Checking','QC Checking');
$stat_array = array('A'=>'ADVANCED','E'=>'EXPECTED','P'=>'PENDING');
$index = $proc[$process_code];
$label = $process[$process_code];
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	data_id = :data_id");
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
$staff = $row[$index . "_staff"];
$stat = $row[$index . "_status"];
$c_num = $row["control_num"];
$plan_status = $row["plan_status"];
$status_label = $stat_array[$plan_status]; 
$remark = $row["remark"];
$site_survey = $row["site_survey"];
$kibiroi = $row["kibiroi"]; 
$today = date("Y-m-d");
?>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Control Number: </h5>
	</div>
	<div class="col-lg-8">
			<input type="text" id="cnum_text" class="modal_cnum default" value="<?php echo $c_num; ?>" tabindex="-1" readonly />
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;"><?php echo $label; ?> Staff: </h5>
	</div>
	<div class="col-lg-8">
		<div class="input-group">
			<input type="text" class="form-control" id="text_staff" value="<?php echo $staff; ?>" placeholder="<?php echo $label; ?> Staff" maxlength="10" style="padding-left: 20px; text-transform:uppercase;" <?php if($stat != null){ echo 'tabindex="-1" disabled'; } ?> />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-user"></span>
			</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;"><?php echo $label; ?> Status: </h5>
	</div>
	<div class="col-lg-8">
		<div class="input-group">
			<?php if($staff == '' || ($stat != $today && $stat != null)){ ?>
				<input type="text" class="form-control"
				style="padding-left: 20px; text-transform:uppercase;" tabindex="-1" disabled
				<?php if($stat != null){echo 'value="FINISHED (' . $stat . ')"'; } ?>
				placeholder="process status" />
				<input type="hidden" id="text_stat" value="<?php echo $stat; ?>" />
			<?php } else { ?>
				<select class="form-control" id="text_stat" style="padding-left: 16px;">
					<option value="">ON PROCESS</option>
					<option value="<?php echo $today; ?>" <?php if($stat == $today){ echo 'selected'; } ?>>FINISHED</option>
				</select>
			<?php } ?>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-dashboard"></span>
			</span>
		</div>
	</div>
</div>
<?php if ( $process_code == 2 || $process_code == 3 ){ ?>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Plan Status: </h5>
	</div>
	<div class="col-lg-8">
		<div class="input-group <?php if($plan_status === 'P'){ echo 'has-error'; } ?>">
			<select class="form-control" id="text_planstat" style="padding-left: 16px;">
				<?php if($plan_status === 'A'){ ?>
					<option value="A" selected>ADVANCED</option>
					<option value="P">PEND</option>
				<?php } else { ?>
					<option value="E">EXPECTED</option>
					<option value="P" <?php if($plan_status === 'P'){ echo 'selected'; } ?>>PEND</option>
				<?php } ?>
			</select>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-stats"></span>
			</span>
		</div>
	</div>
</div>
<?php } ?>
<?php if ( $process_code == 2 ){ ?>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Site Survey: </h5>
	</div>
	<div class="col-lg-8">
		<div class="input-group">
			<input type="text" class="form-control" id="text_ss" maxlength="6" style="padding-left: 20px;"
			value="<?php echo $site_survey; ?>">
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-road"></span>
			</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Kibiroi Status: </h5>
	</div>
	<div class="col-lg-8">
		<div class="input-group <?php if($kibiroi == 2){ echo 'has-error'; } ?>">
			<select class="form-control" id="kibiroi_stat" style="padding-left: 16px;">
				<option value="0"></option>
				<option value="1" <?php if ($kibiroi == 1){echo 'selected';} ?>>ORDERED</option>
				<option value="2" <?php if ($kibiroi == 2){echo 'selected';} ?>>ERROR</option>
			</select>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-barcode"></span>
			</span>
		</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-lg-4">
		<h5 style="font-weight: bold;">Plan Comment: </h5>
	</div>
</div>
<textarea id="text_remark" class="form-control" style="height:200px;"><?php echo $remark; ?></textarea>
<input type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"]; ?>" />
<div id="err_prompt" style="color: red; text-align: center; margin-top: 10px; font-size:1.5em;"></div>