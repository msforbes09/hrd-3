<?php
/*
print_r ($_REQUEST);
*/
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO monitoring_notes
			(group_id,note)
			VALUES
			(:group_id,:note)");
	$stmt->bindValue(':group_id', $_REQUEST["group_id"], PDO::PARAM_INT);
	$stmt->bindValue(':note', $_REQUEST["note"], PDO::PARAM_STR);
	$stmt->execute();
}catch( PDOException $e ){
	echo $e->getMessage();
}
$pdo = null; 
?>