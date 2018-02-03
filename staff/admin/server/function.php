<?php
function get_employment_status(){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from employment_status");
	$stmt->execute();
	$e_stat = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$e_stat .= '<option value="' . $row["status_id"] . '">' . $row["status_desc"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $e_stat;
}
function get_job_category(){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from job_category");
	$stmt->execute();
	$job_cate = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$job_cate .= '<option value="' . $row["category_id"] . '">' . $row["category_desc"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $job_cate;
}
function get_team_list(){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from team");
	$stmt->execute();
	$team_list = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$team_list .= '<option value="' . $row["team_id"] . '">' . $row["team_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $team_list;
}
function get_job_desc($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from job_desc where team_id = :team_id or team_id = 1");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	$job_desc = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$job_desc .= '<option value="' . $row["job_id"] . '">' . $row["job_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $job_desc;
}
?>