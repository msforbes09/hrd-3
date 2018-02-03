<?php
/*
print_r ($_REQUEST);
*/
	try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO fd_monitoring
			(team_id,control_num,plan_status,date_rec)
			VALUES
			(:team_id,:ctrl_num,:p_status,:date)");
	$stmt->bindValue(':team_id', $_REQUEST["team_id"], PDO::PARAM_INT);
	$stmt->bindValue(':ctrl_num', $_REQUEST["ctrl_num"], PDO::PARAM_STR);
	$stmt->bindValue(':p_status', $_REQUEST["p_status"], PDO::PARAM_STR);	
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);	
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
$pdo = null; 
?>