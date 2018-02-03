<?php
$col = $_REQUEST["col"];
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select $col from fd_monitoring
	where
	data_id = :data_id");
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo $row[$col];
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>