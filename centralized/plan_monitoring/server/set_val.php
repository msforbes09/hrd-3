<?php
$col = $_REQUEST["col"];
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"update fd_monitoring 
			set
				$col = :val
			where
				data_id = :data_id"
	);
	$stmt->bindValue(':val', $_REQUEST["val"], PDO::PARAM_STR);
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->execute();
}catch( PDOException $e ){
	echo $e->getMessage();
}
$pdo = null;
?>