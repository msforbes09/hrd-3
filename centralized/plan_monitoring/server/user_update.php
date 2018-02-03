<?php
//previous code saved for reference
$d_stat = set_null($_REQUEST["d_stat"]);
$e_stat = set_null($_REQUEST["e_stat"]);
$c_stat = set_null($_REQUEST["c_stat"]);
$q_stat = set_null($_REQUEST["q_stat"]);
$s_survey = set_null($_REQUEST["s_survey"]);
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"update fd_monitoring 
			set
				design_staff = :d_staff,
				encode_staff = :e_staff,
				check_staff = :c_staff,
				qc_staff = :q_staff,
				design_status = $d_stat,
				encode_status = $e_stat,
				check_status = $c_stat,
				qc_status = $q_stat,
				plan_status = :p_status,
				site_survey = $s_survey,
				remark = :comm
			where
				data_id = :data_id"
	);
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->bindValue(':d_staff', $_REQUEST["d_staff"], PDO::PARAM_STR);
	$stmt->bindValue(':e_staff', $_REQUEST["e_staff"], PDO::PARAM_STR);
	$stmt->bindValue(':c_staff', $_REQUEST["c_staff"], PDO::PARAM_STR);
	$stmt->bindValue(':q_staff', $_REQUEST["q_staff"], PDO::PARAM_STR);
	$stmt->bindValue(':p_status', $_REQUEST["p_status"], PDO::PARAM_STR);
	$stmt->bindValue(':comm', $_REQUEST["comm"], PDO::PARAM_STR);
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