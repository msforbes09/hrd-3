<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from staff");
	$stmt->execute();
	$list_nick_name = array( 0 => "" );
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$list_nick_name += array($row["staff_id"] => $row["nick_name"]);
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
function get_expected($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	plan_status = 'E'
	and
	(qc_status = :date or qc_status is Null )");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_received($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	date_rec = :date");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_released($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	qc_status = :date");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_balance($team_id,$proc){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	qc_status is Null");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_process_balance($team_id,$prev,$proc){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	$prev is not Null
	and
	$proc is Null
	and
	plan_status <> 'P'");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_design_balance($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	design_status is Null
	and
	plan_status <> 'P'");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_pending($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from fd_monitoring
	where
	team_id = :team_id
	and
	plan_status = 'P'");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function get_ongoing($team_id){
	return get_balance($team_id,'qc_status') - get_pending($team_id);
}
function get_comment($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select note from monitoring_notes
	where
	group_id = :team_id
	order by note_id desc limit 0,1");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo $row["note"];
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
}
function check_stat($staff,$stat){
	if ($stat === Null && ($staff <> '' && $staff <> 1 ) ){
		return 'ON PROCESS';
	}else{
		return $stat;
	}
}
function comment($comment){
	if ($comment){
		return ' <span class="glyphicon glyphicon-comment pull-right comm-icon"></span>';
	}
}
function pend($stat){
	if($stat === 'P'){
		return 'bg_pend';
	}
}
function check_pstat($stat,$val){
	$prompt = '';
	if($stat === $val){
		$prompt = 'selected';
	}
	return $prompt;	
}
function set_finished($stat){
	$prompt = 'date_fin';
	if($stat === Null){
		$prompt = '';
	}
	return $prompt;	
}
function btn_comment($comment,$true,$false){
	$prompt = $false;
	if($comment){
		$prompt = $true;
	}
	return $prompt;
}
function get_staff_list($team_id,$staff,$staff_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from staff
	where
	team = :team_id
	and
	employment_stat <> 5
	order by job_desc");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	$staff_list = '<option value="1"></option>';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$staff_list .= '<option value="' . $row["staff_id"] . '"';
		if($staff == $row["staff_id"]){
			$staff_list .= 'selected';
		} else if ($staff_id == $row["staff_id"] && $staff == 1){
			$staff_list .= 'selected';
		}
		$staff_list .= '>' . $row["nick_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $staff_list;
}
function get_output($team, $index){
	$staff = $index . '_staff';
	$status = $index . '_status';
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
		"select
			count(*) as output,
			staff.nick_name as name
		from
			fd_monitoring,
			staff
		where
			team_id = $team
		and
			$status = :date
		and
			staff.staff_id = fd_monitoring.$staff
		group by $staff
		order by output desc");
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	$output = '<div class="individual">';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$output .= $row["name"] . ' : ' . $row["output"] . '<br />'; 
	}
	$output .= '</div>';
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $output;
}
?>