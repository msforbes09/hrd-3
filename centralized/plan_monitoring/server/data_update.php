<?php
$proc = array("design","encode","check","qc")[$_REQUEST["proc_id"]];
$staff = $proc . '_staff';
$status = $proc . '_status';
$command = $staff . ' = :staff,' ;
$command .= $status . ' = ' . set_null($_REQUEST["stat"]) . ',' ;
if($_REQUEST["proc_id"] == 3){
	$command .= 'plan_status = :planstat,' ;
} else if ($_REQUEST["proc_id"] == 2){
	if($_REQUEST["kibiroi"] == 1){$order = date("Y-m-d");} else {$order = '';}
	$command .= 'plan_status = :planstat,' ;
	$command .= 'site_survey = ' . set_null($_REQUEST["ss"]) . ',' ;
	$command .= 'kibiroi_order = ' . set_null($order) . ',' ;
	$command .= 'kibiroi = :kibiroi,' ;
}
$command .= 'remark = :comment' ;
//echo $command .'<br />';
//print_r ($_REQUEST);
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"update fd_monitoring 
			set
				$command
			where
				data_id = :data_id"
	);
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->bindValue(':staff', $_REQUEST["staff"], PDO::PARAM_STR);
	$stmt->bindValue(':comment', $_REQUEST["remark"], PDO::PARAM_STR);
	if($_REQUEST["proc_id"] == 3){
		$stmt->bindValue(':planstat', $_REQUEST["planstat"], PDO::PARAM_STR);
	}  else if ($_REQUEST["proc_id"] == 2){
		$stmt->bindValue(':planstat', $_REQUEST["planstat"], PDO::PARAM_STR);
		$stmt->bindValue(':kibiroi', $_REQUEST["kibiroi"], PDO::PARAM_INT);
	}
	$stmt->execute();
}catch( PDOException $e ){
	echo $e->getMessage();
}
$pdo = null;
/*
*/
function set_null($date){
	if ($date === ''){
		return "Null";
	}else{
		return "'" . $date . "'"; 
	}
}
?>