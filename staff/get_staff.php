<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		staff.staff_id as staff_id,
		staff.id_num as id_num,
		staff.first_name as first_name,
		staff.middle_name as middle_name,
		staff.last_name as last_name,
		staff.nick_name as nick_name,
		employment_status.status_desc as employment_stat,
		staff.job_cate as job_cate,
		job_category.category_desc as job_cate_desc,
		staff.team as team,
		team.team_name as team_name,
		job_desc.job_name as job_desc,
		staff.image as image
	from 
		staff,
		employment_status,
		job_category,
		team,
		job_desc
	where
		employment_status.status_id = staff.employment_stat
		and
		job_category.category_id = staff.job_cate
		and
		team.team_id = staff.team
		and
		job_desc.job_id = staff.job_desc
		and
		staff.staff_id = :id");
	$stmt->bindValue(':id', $_SESSION["id"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$name = $row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"];
	$id = $row["staff_id"];
	$nick_name = $row["nick_name"];
	$team = $row["team"];
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
/*
*/
?>